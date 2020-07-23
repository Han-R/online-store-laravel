<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Client;
use App\Models\Work;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Contact;
use App\Models\Team;
use App\Models\View;
use App\Models\Order;
use App\Models\Sentence;
use App\Models\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $setting = '';
    protected $pages = '';
    protected $services = '';
    public function __construct()
    {
//         if(app()->getLocale()=='ar') {
//             \Carbon\Carbon::setLocale('ar');
//         }else{
//             \Carbon\Carbon::setLocale('en');
//         }
// //        $this->middleware('auth');
         $this->setting = Setting::orderBy('id', 'desc')->first();
         $this->pages = Page::all();
         $this->services = Service::all();


         view()->share('setting', $this->setting);
         view()->share('pages', $this->pages);
         view()->share('services', $this->services);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        return view('site.index');
    }

    public function aboutus()
    {
        $blogs = Blog::orderBy('id', 'desc')->take(6)->get();
        $sentences = Sentence::where('location','about')->get();
        $sentences2 = Sentence::where('location','blog')->get();
        $data = ['blogs'=>$blogs,'sentences'=>$sentences,'sentences2'=>$sentences2];
        return view('aboutus')->with($data);
    }
    public function error()
    {
        return view('error');
    }

    public function services()
    {
        $sentences = Sentence::where('location','services')->get();
        return view('services')->with('sentences',$sentences);
    }
    public function portfolio()
    {
        $works= Work::orderBy('id', 'desc')->get();
        $sentences = Sentence::where('location','portfolio')->get();
        $data = ['works'=>$works,'sentences'=>$sentences];
        return view('portfolio')->with($data);
    }
    public function team()
    {
        $teams= Team::orderBy('order')->get();
        $sentences = Sentence::where('location','team')->get();
        $data = ['teams'=>$teams,'sentences'=>$sentences];
        return view('team')->with($data);
    }
    public function blogs()
    {
        $blogs= Blog::orderBy('id', 'desc')->get();
        $sentences = Sentence::where('location','blog')->get();
        $latestBlogs = Blog::orderBy('id', 'desc')->take(4)->get();
        $mostReadBlogs = Blog::get();
        $mostReadBlogs = $mostReadBlogs->sortByDesc(function($q){
            return $q->views;
        })->take(6);
        $data = ['blogs'=>$blogs,'sentences'=>$sentences,'latestBlogs'=>$latestBlogs,'mostReadBlogs'=>$mostReadBlogs];
        return view('blogs')->with($data);
    }

    public function contactus()
    {
        $sentences = Sentence::where('location','contact')->get();
        return view('contactus')->with('sentences',$sentences);
    }

    public function work($id)
    {
        $work = Work::where(['id'=> $id])->orderBy('id', 'desc')->with('images')->first();
        if($work){
            $view = new View();
            $view->target_id = $id;
            $view->type = 1;
            $view->ip_address = \Request::ip();
            $view->save();
            $data = ['work'=>$work];
            return view('work')->with($data);
        }else{
            return redirect('error');
        }

    }

    public function blog($id)
    {
        $blog = Blog::where(['id'=> $id])->orderBy('id', 'desc')->first();
        if($blog){
            $latestBlogs = Blog::orderBy('id', 'desc')->where('id','<>',$id)->take(4)->get();
            $mostReadBlogs = Blog::all();
            $mostReadBlogs = $mostReadBlogs->sortByDesc(function($q){
                return $q->views;
            })->take(6);
            $comments = Comment::orderBy('id', 'desc')->where('blog_id',$id)->get();
            $searchValues = preg_split('/\s+/', $blog->keywords, -1, PREG_SPLIT_NO_EMPTY);
            $likesBlogs = Blog::where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
//                    $q->orWhere('keywords', 'like', "%{$value}%");
                    $q->whereTranslationLike('title', '%' . $value . '%');
                }
            })->where('id', '<>', $id)->orderBy('id', 'desc')->take(3)->get();
           // return $likesBlogs;
            $view = new View();
            $view->target_id = $id;
            $view->type = 2;
            $view->ip_address = \Request::ip();
            $view->save();
            $data = ['comments'=>$comments,'blog'=>$blog,'latestBlogs'=>$latestBlogs,'mostReadBlogs'=>$mostReadBlogs,'likesBlogs'=>$likesBlogs];
            return view('blog')->with($data);
        }else{
            return redirect('error');
        }
    }

    public function contactusMsg(Request $request)
    {
        $name = $request['name'];
        $email = $request['email'];
        $mobile = $request['mobile'];
        $subject = $request['subject'];
        $message = $request['message'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return 'false';
        }
        else {
            $contact = new Contact();
            $contact->name = $name;
            $contact->email = $email;
            $contact->mobile = $mobile;
            $contact->subject = $subject;
            $contact->message = strip_tags($message);
            $contact->ip_address = \Request::ip();
            $done = $contact->save();
            if($done){
              //  return redirect()->back()->with('success','Done Successfully' );
                return 'success';
            }else{
               // return redirect()->back()->with('error',' whoops something went wrong');
                return 'false';
            }
        }
    }

    public function addComment(Request $request)
    {
        $name = $request['name'];
        $blog_id = $request['blog_id'];
        $text = $request['text'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'blog_id' => 'required',
            'text' => 'required',
        ]);
        if ($validator->fails()) {
             return 'false';
        }
        else {
            $blog = Blog::findOrFail($blog_id);
            if($blog) {
                $new = new Comment();
                $new->name = $name;
                $new->blog_id = $blog_id;
                $new->text = strip_tags($text);
                $new->ip_address = \Request::ip();
                $done = $new->save();
                if ($done) {
                    return 'success';
                } else {
                    return 'false';
                }
            }
            else {
                return 'false';
            }
        }
    }


    public function order(Request $request)
    {
//return $request->all();
        $name = $request['name'];
        $email = $request['email'];
        $mobile = $request['mobile'];
        $services = $request['services'];
        $note = $request['note'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'services' => 'required',
        ]);
        if ($validator->fails()) {
            return 'false1';
        }
        else {
            $order = new Order();
            $order->name = $name;
            $order->email = $email;
            $order->mobile = $mobile;
            $order->services = implode("-",$services);
            $order->note = strip_tags($note);
            $order->ip_address = \Request::ip();
            $done = $order->save();
            if($done){
                return 'success';
            }
            return 'false2';
        }



    }

    public function test(){
        return bcrypt('hexa@2020');
    }
    public function test2()
    {
        $work = Work::where(['id'=> 2])->orderBy('id', 'desc')->with('images')->first();
        if($work){
            $view = new View();
            $view->target_id = 2;
            $view->type = 1;
            $view->ip_address = \Request::ip();
            $view->save();
           return "done";
        }else{
            return "error";
        }

    }

}
