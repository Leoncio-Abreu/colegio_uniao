<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Redirect;
use Setting;
use App\Atividade;
use App\Noticia;
use App\Noticiadestaque;
use App\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Input;
use Image;
use Mail;
use App\Links;
use App\Ano;
use App\Unidade;
use App\Turma;
use App\Album;
use App\Foto;
use Zofe\Rapyd\Rapyd;

class HomeController extends Controller
{
	public function __construct(Application $app, Audit $audit) {
        // this function will run before every action in the controller

        parent::__construct($app, $audit);
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'home']);

        $this->beforeFilter(function()
        {
	    $slides = Slide::orderBy('posicao','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
                    ->get();
		$links = Links::get();
		view::share('slides',$slides);
		view::share('links',$links);
	});
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $homeRouteName = 'welcome';

        try {
            $homeCandidateName = Setting::get('app.home_route');
            $homeRouteName = $homeCandidateName;
        }
        catch (Exception $ex) { } // Eat the exception will default to the welcome route.

        $request->session()->reflash();
        return Redirect::route($homeRouteName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $request->session()->reflash();
		$noticias = Noticia::orderBy('posicao','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->take(7)
                    ->get();
 		$atividades = Atividade::orderBy('posicao','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->take(4)
                    ->get();
// 		$links = Atividade::take(4)->get();
		return view('welcome',compact('noticias', 'atividades'));
    }

	public function viewatividade($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Atividade::where('id', '=', $id)
					->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
					->where('ativo', '=', '1')
					->value('posicao');
			If (!is_null($dnow)){
				$prevPages = Atividade::orderBy('posicao','desc')
						->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
						->where('posicao', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($prevPages)){ $prevPages = null;}		
				$nextPages = Atividade::orderBy('posicao','desc')
						->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
						->where('posicao', '<', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($nextPages)){ $nextPages = null;}		
	
				$atividade = Atividade::where('id', '=', $id)->first();
			}
			else{
				$prevPages = null;
				$nextPages = null;
				$atividade = null;
				return view('welcome', compact('atividade', 'prevPages', 'nextPages'));
			}
			if (!is_null($atividade)) {
				return view('atividade', compact('atividade', 'prevPages', 'nextPages'));
			}
			else {
				return view('welcome', compact('atividade', 'prevPages', 'nextPages'));
			
			}
		}
	}

    public function viewnoticia($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Noticia::where('id', '=', $id)
					->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
					->where('ativo', '=', '1')
					->value('posicao');
			If (!is_null($dnow)){
				$prevPages = Noticia::orderBy('posicao','desc')
						->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
						->where('posicao', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($prevPages)){ $prevPages = null;}		
				$nextPages = Noticia::orderBy('posicao','desc')
						->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
						->where('posicao', '<', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($nextPages)){ $nextPages = null;}		
	
				$noticia = Noticia::where('id', '=', $id)->first();
			}
			else{
				$prevPages = null;
				$nextPages = null;
				$noticia = null;
				return view('welcome', compact('noticia', 'prevPages', 'nextPages'));
			}
			if (!is_null($noticia)) {
				return view('noticia', compact('noticia', 'prevPages', 'nextPages'));
			}
			else {
				return view('welcome', compact('noticia', 'prevPages', 'nextPages'));
			
			}
		}
	}

	public function unidades()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('unidades', compact('page_title', 'page_description'));
    }

    public function historia()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('historia', compact('page_title', 'page_description'));
    }

    public function contato()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('contato', compact('page_title', 'page_description'));
    }

    public function painel()
    {
        $page_title = "Bem vindo";
        $page_description = "";

        return view('blank', compact('page_title', 'page_description'));
    }
	
	public function imageupload()
	{
		$width=\Input::get('width');
		$height=\Input::get('height');
		if(\Request::ajax())
		{
			$file = \Input::file('image');
//			dd($file->getRealPath());
			if (!is_null($file))
			{
				$fileName = time().'.'.$file->getClientOriginalExtension();
				$move = Image::make($file->getRealPath())->resize($width, $height, function ($c) {
        $c->aspectRatio();
        $c->upsize();
})->save(public_path()."/upload/imageupload/".$fileName);
//$img = Image::canvas($width, $height);
//$image = Image::make($path);
//				$move = $file->move(public_path()."/upload/imageUpload/", $fileName);
				return \Response::json(\Request::server('HTTP_HOST').'/upload/imageupload/'. $fileName);
			}
		}
	}
	public function posicao($table=null,$move=null,$id=null)
	{
		$pos=null;
		$ppos=null;
		$pid=null;
		$npos=null;
		$nid=null;
		$i = explode(".",$table);
		if (count($i) > 1) {
		    $route = $table;
		    $table = $i[count($i)-1];
		}
		$tb=['noticias', 'atividades', 'slides', 'anos', 'unidades', 'turmas', 'galerias', 'albums', 'images'];
		$mv=['up', 'down'];

		if (!is_null($table) & !is_null($move) & !is_null($id) & in_array($table,$tb) & in_array($move,$mv))
		{
			$apos = \DB::table($table)->where('id', '=', $id)
						->take(1)
						->get();
			If (count($apos)){
				$pos=$apos[0]->posicao;
				$id=$apos[0]->id;
				$prevpos = \DB::table($table)->orderBy('posicao','desc')
					->where('posicao', '<', $pos)
					->take(1)
					->get();
				If (count($prevpos)){
					$ppos=$prevpos[0]->posicao;
					$pid=$prevpos[0]->id;
				};
				$nextpos = \DB::table($table)->orderBy('posicao','asc')
					->where('posicao', '>', $pos)
					->take(1)
					->get();
				If (count($nextpos)){
					$npos=$nextpos[0]->posicao;
					$nid=$nextpos[0]->id;
				};
				if ($move == 'up' & !is_null($npos))
				{
					\DB::table($table)
						->where('id', $id)
						->update(array('posicao' => $npos));
					\DB::table($table)
						->where('id', $nid)
						->update(array('posicao' => $pos));

				}
				else if ($move == 'down' & !is_null($ppos))
				{
					\DB::table($table)
						->where('id', $id)
						->update(array('posicao' => $ppos));
					\DB::table($table)
						->where('id', $pid)
						->update(array('posicao' => $pos));
				}
			}
		}
		return Redirect::back();
	}

    public function indexanos()
    {
        $page_title = 'Anos';
	$page_description = 'Pesquisar anos';
	$title = 'Anos';
	$route = 'anos';

        $filter = \DataFilter::source(Ano::where('ativo','=',1));
	$filter->add('id','Ano','select')->rule('required')->option("","")->options(Ano::orderBy('posicao','desc')->lists('name','id'));
        $filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/anos/create","Criar novo Ano");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/galerias.anos/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.anos/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Nome', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/anos/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->build();
	$back = 'null';
	$id = '';
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','id','back'));
    }

    public function viewanos($id = null)
    {
	$page_title = Ano::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Unidades do ano de '.Ano::where('id', '=', $id)->pluck('name');
	$title = 'Unidade';
	$route = 'unidades';
	
        $filter = \DataFilter::source(Unidade::where('ano_id', '=', $id)->where('ativo','=',1)->orderBy('posicao','asc'));
	$filter->add('ano_id','Ano','select')->rule('required')->option("","")->options(Ano::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/unidades/create?id=".$id,"Criar nova Unidade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = '';
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'id', 'back'));
    }

    public function viewunidades($id = null)
    {
        $page_title = Unidade::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Turmas da '.Unidade::where('id', '=', $id)->pluck('name');
	$title = 'Turma';
	$route = 'turmas';
	
        $filter = \DataFilter::source(Turma::where('unidade_id', '=', $id)->where('ativo','=',1)->orderBy('posicao','asc'));
	$filter->add('unidade_id','Unidade','select')->option("","")->options(Unidade::orderBy('posicao','desc')->where('ano_id','=',Unidade::where('id', '=', $id)->pluck('ano_id'))->lists('name','id'));
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/turmas/create?id=".$id,"Criar nova Turma");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'anos';
	$id = Unidade::where('id', '=', $id)->pluck('ano_id');
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','id', 'back'));
    }

    public function viewturmas($id)
    {
        $page_title = Turma::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Albums do(a) '.Turma::where('id', '=', $id)->pluck('name');
	$title = 'Albums';
	$route = 'albums';

        $filter = \DataFilter::source(Album::where('turma_id', '=', $id)->where('ativo','=',1)->orderBy('posicao','asc'));
	$filter->add('turma_id','Turma','select')->rule('required')->option("","")->options(Album::orderBy('posicao','desc')->where('turma_id', '=', $id)->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/albums/create?id=".$id,"Criar novo Album");
        $filter->build();

        $grid = \DataGrid::source($filter);
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'unidades';
	$id = Turma::where('id', '=', $id)->pluck('unidade_id');
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back', 'id'));
    }

    public function viewalbums($id = null)
    {
        $page_title = Album::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Fotos do Album '.Album::where('id', '=', $id)->pluck('name');
	$title = 'Fotos';
	$route = 'images';
	$filter="";

	$filter = \DataFilter::source(Foto::where('album_id', '=', $id)->orderBy('posicao','asc'));
//	$filter->add('album_id','Album','select')->rule('required')->option("","")->options(Foto::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
//	$filter->submit('Filtrar');
//        $filter->reset('Resetar');
        $filter->link("galerias/images/upload?id=".$id,"Adicionar Fotos");
        $filter->build();


        $grid = \DataGrid::source($filter);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'turmas';
	$id = Album::where('id', '=', $id)->pluck('turma_id');
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }
}
