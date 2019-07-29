<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\IssuesRepository;
use App\Repositories\ArticlesRepository;

class ArticlesController extends SiteController
{
    public function __construct(IssuesRepository $i_rep, ArticlesRepository $a_rep)
    {
        parent::__construct(
            new \App\Repositories\MenusRepository(new \App\Models\Menu),
            new \App\Repositories\TagsRepository(new \App\Models\Tag)
        );

        $this->i_rep = $i_rep;
        $this->a_rep = $a_rep;

        $this->template = 'front.articles';

        $this->show_stol_menu = (config('app.locale') == 'ru') ? true : false;

    }

    /*
     *
     *  Render articles list of last Issue
     *
     */
    public function index(Request $request)
    {

        $this->setStatus();
      
        if (!$request->year || !$request->no || !$request->part) {
            return $this->redirectOnLastIssue();
        }

        $this->prepareStolMenu();

//         $issue = $this->getIssue($request, $this->onlyPublished);
        $issue = $this->getIssue($request, $this->status);
        if (!$issue) { return $this->redirectOnLastIssue(); }

        $nextIssue = $this->i_rep->getNextIssue($issue, $this->status);
        $prevIssue = $this->i_rep->getPrevIssue($issue, $this->status);

        $this->title = view('front.articles_title')->with('issue', $issue)->render();

        $this->subtitle = __('Содержание тома');

        $this->vars = array_add($this->vars, 'issue', $issue);
        $this->vars = array_add($this->vars, 'nextIssue', $nextIssue);
        $this->vars = array_add($this->vars, 'prevIssue', $prevIssue);

        return $this->renderOutput();
    }



    /*
     *
     *  Render current article
     *
     */
    public function show(Article $article)
    {
        $this->setStatus();

        if (auth()->guest() && !$article->status->type) {
            return abort(404, 'Статья не найдена');
        }

        $this->prepareStolMenu();

        $this->template = 'front.article';

        $this->title = view('front.articles_title')->with('issue', $article->issue)->render();

        $this->subtitle = $article->loc->title;

        $this->vars = array_add($this->vars, 'article', $article);
      
        /* Previous + Next Articles */

            $issue = $article->issue;
            $issue->loadMissing([
            'articles',
            'articles.status',
            'articles.meta'
            ]);
            $issue = ($this->onlyPublished) ? $issue->published() : $issue ;

            $index = $issue->articles->search(function($item) use ($article){
                return $item->alias == $article->alias;
            });  

            $prevArticle = ($index > 0)
                        ? $issue->articles[$index - 1]
                        : false;
            $this->vars = array_add($this->vars, 'prevArticle', $prevArticle);

            $nextArticle = ($index < count($issue->articles) - 1 )
                        ? $issue->articles[$index + 1]
                        : false;
            $this->vars = array_add($this->vars, 'nextArticle', $nextArticle);

        return $this->renderOutput();
    }
  
    
    /*
    *
    *   Render Archive
    *
    */
    public function archive() 
    {
          $this->setStatus();

          $this->prepareStolMenu();

          $this->template = 'front.archive';

          $this->title = __('Архив');
      
        //   $issues = ($this->status) ? $this->i_rep->allByStatus($this->status) : $this->i_rep->all();
          $issues = $this->i_rep->allByStatus($this->status) ;
    //   dump($issues);
          $years = $issues
                    ->mapToGroups(function($issue) {
                        return [ $issue->full_no => $issue];
                    })
                    ->mapToGroups(function($full_no) {
                        return [ $full_no[0]->year => $full_no];
                    })
                    // ->sort()
                    ;
            
          $this->vars = array_add($this->vars, 'years', $years);
      
          return $this->renderOutput();
    }
  
  
    /*
    *   Search articles
    */
    public function search(Request $request)
    {
        $this->setStatus();

        $this->prepareStolMenu();

        $this->template = 'front.search';

        $request->request->add([
            'paginate' => '10',
            'status' => $this->status,
            'relation' => [],
            'sortBy' => 'issue',
            'orderBy' => 'desc'
        ]);
        $articles = $this->a_rep->getArticlesList($request);

        $articles->withPath("search");
        $articles->appends(['search' => $request->input('search')]);

        $this->vars = array_add($this->vars, 'articles', $articles);
      
        $this->title = __('Поиск:'). ' "'.$request->input('search').'"';

        $this->subtitle = (count($articles) > 0 )
           ? trans_choice('search.found', $articles->total(), ['s' => $request->input('search'), 'a' => $articles->total()])
           : __('search.noarticles');
      
        return $this->renderOutput();
    }
  

    /*
     *
     *  Check last Issue and rerirect if it isset
     *
     */
    private function redirectOnLastIssue()
    {

        $issue = $this->i_rep->oneLastByStatus($this->status);

        if ($issue) {
            return redirect()->route('articles', [
                'year' => $issue->year,
                'no' => $issue->no,
                'part' => $issue->part,
            ]);
        } else {
            return die('Записей нет');
        }
    }

    /*
     *
     */
    private function getIssue(Request $request, $articleStatus = '*')
    {

        $issue = $this->i_rep->getIssueByRequest($request->all());

        if ($issue) {
            $issue = ($this->onlyPublished) ? $issue->published(): $issue;
            if (count($issue->articles) > 0) {
//                 $issue = $this->i_rep->getIssuesByArticleStatus($articleStatus, $issue);
//                 $issue = $this->i_rep->prepareIssue($issue);
                return $issue;
            }
        }

        return null;
    }


}
