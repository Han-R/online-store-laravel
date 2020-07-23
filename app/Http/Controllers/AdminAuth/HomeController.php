<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use Response;
use Image;
use Hash;
use Mail;
use Crypt;

use App\Models\Setting;
use App\Models\Language;
use App\Models\Client;
use App\Models\Work;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Sentence;
use App\Models\Team;
use App\Models\Attatchment;
use App\Models\Order;
use App\Models\Blog;
use App\Models\Page;

use App\Notifications\arabicEmailReset;

use Carbon\Carbon;

class HomeController extends Controller
{
    protected $settings = '';
    protected $locales = '';
 //   protected $sentences = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
     //   $this->sentences = Sentence::get();

        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
     //   view()->share('sentences', $this->sentences);
        // view()->share('pages', $this->pages);
        // view()->share('meal', $this->meal);
    }

    public function home()
    {
//      return  Auth::guard('admin')->user()->id;

       // $data = ['meals'=>$meals,'restaurants'=>$restaurants,'drivers'=>$drivers,'users'=>$users,'orders'=>$orders];
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.settings');
    }


    public function sentences()
    {
        $sentences =   Sentence::all();
        return view('admin.sentences')->with('sentences',$sentences);
    }

    public function sentence_create()
    {
        return view('admin.sentence_create');
    }

    public function sentence_create_post(Request $request)
    {
        $sentence = new Sentence();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $sentence->translateOrNew($locale)->text = $request->get('text_' . $locale);
        }
        $sentence->location=$request->get('location');
        $sentence->order=$request->get('order');
        $done = $sentence->save();
        if ($done) {
            return redirect()->back()->with('success','تم  اضافة جملة جديدة بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function sentence_edit($sentence_id)
    {
        $sentence =   Sentence::where('id',$sentence_id)->first();
        return view('admin.sentence_edit')->with('sentence',$sentence);
    }

    public function sentence_edit_post(Request $request)
    {
        $sentence = Sentence::where('id',$request->get('sentence_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $sentence->translateOrNew($locale)->text = $request->get('text_' . $locale);
        }
        $sentence->location=$request->get('location');
        $sentence->order=$request->get('order');
        $done = $sentence->save();
        if ($done) {
            return redirect()->back()->with('success','تم تعديل محتوى الجملة بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function sentence_delete($sentence_id)
    {
        $sentence = Sentence::where('id',$sentence_id)->first();
        if($sentence->delete()){
            return 'success';
        }
        return 'false';
    }



    public function Edit_Settings(Request $request)
    {
//        {{--`name`, `description`, `keywords`, `sliderTitle`, `sliderText`, `address`, `about_us`, `our_vision`, `our_mision`, `marketing`, `designing`, `developement`--}}
//        {{--`mobile`, `email`, `total_projects`, `total_clients`, `total_employee`, `facebook`, `twitter`, `linked_in`, `instegram`, `dribbble`, `behance`, `google_plus`, `about_us_photo`--}}
        $locales = Language::all()->pluck('lang');
        $updateSettings =Setting::orderBy('id','desc')->first();
        foreach ($locales as $locale)
        {
            $updateSettings->translateOrNew($locale)->name = ucwords($request->get('name_' . $locale));
            $updateSettings->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $updateSettings->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $updateSettings->translateOrNew($locale)->sliderTitle = $request->get('sliderTitle_' . $locale);
            $updateSettings->translateOrNew($locale)->sliderText = $request->get('sliderText_' . $locale);
            $updateSettings->translateOrNew($locale)->about_us = $request->get('about_us_' . $locale);
            $updateSettings->translateOrNew($locale)->our_vision = $request->get('our_vision_' . $locale);
            $updateSettings->translateOrNew($locale)->our_mision = $request->get('our_mision_' . $locale);
            $updateSettings->translateOrNew($locale)->marketing = $request->get('marketing_' . $locale);
            $updateSettings->translateOrNew($locale)->designing = $request->get('designing_' . $locale);
            $updateSettings->translateOrNew($locale)->developement = $request->get('developement_' . $locale);
            $updateSettings->translateOrNew($locale)->marketingList = $request->get('marketingList_' . $locale);
            $updateSettings->translateOrNew($locale)->designingList = $request->get('designingList_' . $locale);
            $updateSettings->translateOrNew($locale)->developementList = $request->get('developementList_' . $locale);

        }
        $updateSettings->mobile = $request->get('mobile');
        $updateSettings->email = $request->get('email');
        $updateSettings->total_projects = $request->get('total_projects');
        $updateSettings->total_clients = $request->get('total_clients');
        $updateSettings->total_employee = $request->get('total_employee');
        $updateSettings->facebook = $request->get('facebook');
        $updateSettings->twitter = $request->get('twitter');
        $updateSettings->linked_in = $request->get('linked_in');
        $updateSettings->instegram = $request->get('instegram');
        $updateSettings->dribbble = $request->get('dribbble');
        $updateSettings->behance = $request->get('behance');
        if ($request->hasFile('about_us_photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('about_us_photo')->getClientOriginalExtension();
            $request->file('about_us_photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->about_us_photo = 'uploads/'.$name;
        }
        if ($request->hasFile('our_vision_photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('our_vision_photo')->getClientOriginalExtension();
            $request->file('our_vision_photo')->move("uploads/", $name);
//          Image::make($request->file('our_vision_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->our_vision_photo = 'uploads/'.$name;
        }
        if ($request->hasFile('our_mision_photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('our_mision_photo')->getClientOriginalExtension();
            $request->file('our_mision_photo')->move("uploads/", $name);
//          Image::make($request->file('our_mision_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->our_mision_photo = 'uploads/'.$name;
        }


        if ($request->hasFile('marketingPhoto')) {
            $name = time()."_".rand(10000,99999).".".$request->file('marketingPhoto')->getClientOriginalExtension();
            $request->file('marketingPhoto')->move("uploads/", $name);
//          Image::make($request->file('marketingPhoto'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->marketingPhoto = 'uploads/'.$name;
        }
        if ($request->hasFile('designingPhoto')) {
            $name = time()."_".rand(10000,99999).".".$request->file('designingPhoto')->getClientOriginalExtension();
            $request->file('designingPhoto')->move("uploads/", $name);
//          Image::make($request->file('designingPhoto'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->designingPhoto = 'uploads/'.$name;
        }
        if ($request->hasFile('developementPhoto')) {
            $name = time()."_".rand(10000,99999).".".$request->file('developementPhoto')->getClientOriginalExtension();
            $request->file('developementPhoto')->move("uploads/", $name);
//          Image::make($request->file('developementPhoto'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $updateSettings->developementPhoto = 'uploads/'.$name;
        }
        $done = $updateSettings->save();
        if($done){
            return redirect()->back()->with('success','تم حفظ الاعدادات بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function orders()
    {
        $orders = Order::orderBy('seen','asc')->get();
        return view('admin.orders')->with('orders',$orders);
    }

    public function order_view($order_id)
    {
        $order = Order::where('id',$order_id)->first();
        $services =  explode('-',$order->services);
        $servicesList = Service::whereIn('id',$services)->get();
        $order->update(['seen'=>1]);
        return view('admin.order_view')->with(['order'=>$order,'servicesList'=>$servicesList]);
    }

    public function contacts()
    {
        $contacts = Contact::orderBy('seen','asc')->get();
        return view('admin.contacts')->with('contacts',$contacts);
    }

    public function contact_view($contact_id)
    {
        $contact = Contact::where('id',$contact_id)->first();
        $contact->update(['seen'=>1]);
        return view('admin.contact_view')->with(['contact'=>$contact]);
    }

//    public function order_delete($order_id)
//    {
//        $order = Order::where('id',$order_id)->first();
//        if($order->delete()){
//            return 'success';
//        }
//        return 'false';
//    }

    public function teams()
    {
        $teams = Team::orderBy('type', 'ASC')->orderBy('order', 'ASC')->get();
        return view('admin.teams')->with('teams',$teams);
    }

    public function team_create()
    {
        return view('admin.team_create');
    }

    public function team_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $new = new Team();
        foreach ($locales as $locale)
        {
            $new->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $new->translateOrNew($locale)->position = $request->get('position_' . $locale);
        }
        $new->linked_in = $request->get('linked_in');
        $new->order = $request->get('order');
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $new->photo = 'uploads/'.$name;
        }
        $new->type = $request->get('type');
        $done = $new->save();
        if ($done) {
            return redirect()->back()->with('success','تم اضافة عضو جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function team_edit($team_id)
    {
        $team = Team::where('id',$team_id)->orderBy('id','desc')->first();
        return view('admin.team_edit')->with(['team'=>$team]);
    }

    public function team_edit_post(Request $request)
    {

        $team = Team::where('id',$request->get('team_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $team->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $team->translateOrNew($locale)->position = $request->get('position_' . $locale);
        }
        $team->order = $request->get('order');
        $team->linked_in = $request->get('linked_in');
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $team->photo = 'uploads/'.$name;
        }
        $team->type = $request->get('type');
        $done = $team->save();
        if ($done) {
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات عضو جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }


    }

    public function team_delete($team_id)
    {
        $team = Team::where('id',$team_id)->first();
        if($team->delete()){
            return 'success';
        }
        return 'false';
    }

    public function works()
    {
        $works = Work::all();
        return view('admin.works')->with('works',$works);
    }

    public function work_create()
    {
        return view('admin.work_create');
    }

    public function work_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $work = new Work();
        foreach ($locales as $locale)
        {
            $work->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $work->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $work->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $work->translateOrNew($locale)->feature = $request->get('feature_' . $locale);
            $work->translateOrNew($locale)->client = $request->get('client_' . $locale);
            $work->translateOrNew($locale)->industry = $request->get('industry_' . $locale);
            $work->translateOrNew($locale)->services = $request->get('services_' . $locale);
        }
        $work->color1 = $request->get('color1');
        $work->color2 = $request->get('color2');
        $work->dribbble = $request->get('dribbble');
        $work->behance = $request->get('behance');
        $work->ios = $request->get('ios');
        $work->android = $request->get('android');
        $work->site = $request->get('site');
        if ($request->hasFile('cover')) {
            $name = time()."_".rand(10000,99999).".".$request->file('cover')->getClientOriginalExtension();
            $request->file('cover')->move("uploads/", $name);
//          Image::make($request->file('cover'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $work->cover = 'uploads/'.$name;
        }
        if ($request->hasFile('mockup')) {
            $name = time()."_".rand(10000,99999).".".$request->file('mockup')->getClientOriginalExtension();
            $request->file('mockup')->move("uploads/", $name);
//          Image::make($request->file('mockup'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $work->mockup = 'uploads/'.$name;
        }
        $done = $work->save();
        if ($done) {
            if (is_array($request->attatchments) || is_object($request->attatchments)) {
                foreach ($request->attatchments as $i => $value) {
                    $extension[$i] = strtolower($request->attatchments[$i]->getClientOriginalExtension());
                    $fileName[$i] = time() . "_" . rand(10000, 99999) . '.' . $extension[$i];
                    $request->attatchments[$i]->move('uploads/', $fileName[$i]);
                    $atta = New Attatchment;
                    $atta->work_id = $work->id;
                    $atta->name = 'uploads/'.$fileName[$i];
                    $atta->save();
                }
            }
            return redirect()->back()->with('success','تم اضافة عمل جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function work_edit($work_id)
    {
        $work = Work::where('id',$work_id)->orderBy('id','desc')->with('images')->first();
        return view('admin.work_edit')->with('work',$work);
    }

    public function work_edit_post(Request $request)
    {
//        return $request->all();
        $work = Work::where('id', $request->get('work_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $work->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $work->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $work->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $work->translateOrNew($locale)->feature = $request->get('feature_' . $locale);
            $work->translateOrNew($locale)->client = $request->get('client_' . $locale);
            $work->translateOrNew($locale)->industry = $request->get('industry_' . $locale);
            $work->translateOrNew($locale)->services = $request->get('services_' . $locale);
        }
        $work->color1 = $request->get('color1');
        $work->color2 = $request->get('color2');
        $work->dribbble = $request->get('dribbble');
        $work->behance = $request->get('behance');
        $work->ios = $request->get('ios');
        $work->android = $request->get('android');
        $work->site = $request->get('site');
        if ($request->hasFile('cover')) {
            $name = time()."_".rand(10000,99999).".".$request->file('cover')->getClientOriginalExtension();
            $request->file('cover')->move("uploads/", $name);
//          Image::make($request->file('uploads'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $work->cover = 'uploads/'.$name;
        }
        if ($request->hasFile('mockup')) {
            $name = time()."_".rand(10000,99999).".".$request->file('mockup')->getClientOriginalExtension();
            $request->file('mockup')->move("uploads/", $name);
//          Image::make($request->file('mockup'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $work->mockup = 'uploads/'.$name;
        }
        $done = $work->save();
        if ($done) {
            if (is_array($request->attatchments) || is_object($request->attatchments)) {
                foreach ($request->attatchments as $i => $value) {
                    $extension[$i] = strtolower($request->attatchments[$i]->getClientOriginalExtension());
                    $fileName[$i] = time() . "_" . rand(10000, 99999) . '.' . $extension[$i];
                    $request->attatchments[$i]->move('uploads/', $fileName[$i]);
                    $atta = New Attatchment;
                    $atta->work_id = $work->id;
                    $atta->name = 'uploads/'.$fileName[$i];
                    $atta->save();
                }
            }
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات العمل بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function work_delete($work_id)
    {
        $work = Work::where('id',$work_id)->first();
        if($work->delete()){
            return 'success';
        }
        return 'false';
    }

    public function deleteAttachment($attach_id)
    {
        $attach = Attatchment::where('id',$attach_id)->first();
        if($attach->delete()){
            return 'success';
        }
        return 'false';
    }

    public function clients()
    {
        $clients = Client::all();
        return view('admin.clients')->with('clients',$clients);
    }

    public function client_create()
    {
        return view('admin.client_create');
    }

    public function client_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $new = new Client();
        foreach ($locales as $locale)
        {
            $new->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $new->link = $request->get('link');
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $new->photo = 'uploads/'.$name;
        }
        $done = $new->save();
        if ($done) {
            return redirect()->back()->with('success','تم اضافة عميل جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function client_edit($client_id)
    {
        $client = Client::where('id',$client_id)->orderBy('id','desc')->first();
        return view('admin.client_edit')->with(['client'=>$client]);
    }

    public function client_edit_post(Request $request)
    {

        $client = Client::where('id',$request->get('client_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $client->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $client->link = $request->get('link');
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $client->photo = 'uploads/'.$name;
        }
        $done = $client->save();
        if ($done) {
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات عميل جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }


    }

    public function client_delete($client_id)
    {
        $client = Client::where('id',$client_id)->first();
        if($client->delete()){
            return 'success';
        }
        return 'false';
    }

    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials')->with('testimonials',$testimonials);
    }

    public function testimonial_create()
    {
        return view('admin.testimonial_create');
    }

    public function testimonial_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $new = new Testimonial();
        foreach ($locales as $locale)
        {
            $new->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $new->translateOrNew($locale)->text = $request->get('text_' . $locale);
        }
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $new->photo = 'uploads/'.$name;
        }
        $done = $new->save();
        if ($done) {
            return redirect()->back()->with('success','تم اضافة عميل جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function testimonial_edit($testimonial_id)
    {
        $testimonial = Testimonial::where('id',$testimonial_id)->orderBy('id','desc')->first();
        return view('admin.testimonial_edit')->with(['testimonial'=>$testimonial]);
    }

    public function testimonial_edit_post(Request $request)
    {

        $testimonial = Testimonial::where('id',$request->get('testimonial_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $testimonial->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $testimonial->translateOrNew($locale)->text = $request->get('text_' . $locale);
        }
        if ($request->hasFile('photo')) {
            $name = time()."_".rand(10000,99999).".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
            $testimonial->photo = 'uploads/'.$name;
        }
        $done = $testimonial->save();
        if ($done) {
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات عميل جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }


    }

    public function testimonial_delete($testimonial_id)
    {
        $testimonial = Testimonial::where('id',$testimonial_id)->first();
        if($testimonial->delete()){
            return 'success';
        }
        return 'false';
    }



    public function blogs()
    {
        $blogs = Blog::all();
        return view('admin.blogs')->with('blogs',$blogs);
    }

    public function blog_create()
    {
        return view('admin.blog_create');
    }

    public function blog_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $new = new Blog();
        foreach ($locales as $locale)
        {
            $new->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $new->translateOrNew($locale)->text = $request->get('text_' . $locale);
            $new->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $new->translateOrNew($locale)->first_paragraph = $request->get('first_paragraph_' . $locale);
            $new->translateOrNew($locale)->quotation = $request->get('quotation_' . $locale);
            if ($request->hasFile('imageBlog_' . $locale)) {
                $name = time()."_".rand(10000,99999).".".$request->file('imageBlog_' . $locale)->getClientOriginalExtension();
                $request->file('imageBlog_' . $locale)->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
                $new->translateOrNew($locale)->imageBlog = 'uploads/'.$name;
            }
        }
        $new->category = $request->get('category');

//        if ($request->hasFile('image')) {
//            $name = time()."_".rand(10000,99999).".".$request->file('image')->getClientOriginalExtension();
//            $request->file('image')->move("uploads/", $name);
////          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
//            $new->image = 'uploads/'.$name;
//        }
        $done = $new->save();
        if ($done) {
            return redirect()->back()->with('success','تم اضافة موضوع جديد بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function blog_edit($blog_id)
    {
        $blog = Blog::where('id',$blog_id)->orderBy('id','desc')->first();
        return view('admin.blog_edit')->with(['blog'=>$blog]);
    }

    public function blog_edit_post(Request $request)
    {

        $blog = Blog::where('id',$request->get('blog_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $blog->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $blog->translateOrNew($locale)->text = $request->get('text_' . $locale);
            $blog->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $blog->translateOrNew($locale)->first_paragraph = $request->get('first_paragraph_' . $locale);
            $blog->translateOrNew($locale)->quotation = $request->get('quotation_' . $locale);
            if ($request->hasFile('imageBlog_' . $locale)) {
                $name = time()."_".rand(10000,99999).".".$request->file('imageBlog_' . $locale)->getClientOriginalExtension();
                $request->file('imageBlog_' . $locale)->move("uploads/", $name);
//          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
                $blog->translateOrNew($locale)->imageBlog = 'uploads/'.$name;
            }
        }
        $blog->category = $request->get('category');
//        if ($request->hasFile('image')) {
//            $name = time()."_".rand(10000,99999).".".$request->file('image')->getClientOriginalExtension();
//            $request->file('image')->move("uploads/", $name);
////          Image::make($request->file('about_us_photo'))->resize(800, null, function ($constraint) { $constraint->aspectRatio();})->save("uploads/$name");
//            $blog->image = 'uploads/'.$name;
//        }
        $done = $blog->save();
        if ($done) {
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات الموضوع بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }


    }

    public function blog_delete($blog_id)
    {
        $blog = Blog::where('id',$blog_id)->first();
        if($blog->delete()){
            return 'success';
        }
        return 'false';
    }




    public function pages()
    {
        $pages = Page::all();
        return view('admin.pages')->with('pages',$pages);
    }

    public function page_create()
    {
        return view('admin.page_create');
    }

    public function page_create_post(Request $request)
    {
        $locales = Language::all()->pluck('lang');
        $new = new Page();
        $new->name = $request->get('name');
        foreach ($locales as $locale)
        {
            $new->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $new->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $new->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $done = $new->save();
        if ($done) {
            return redirect()->back()->with('success','تم اضافة صفحة جديدة بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }
    }

    public function page_edit($page_id)
    {
        $page = Page::where('id',$page_id)->orderBy('id','desc')->first();
        return view('admin.page_edit')->with(['page'=>$page]);
    }

    public function page_edit_post(Request $request)
    {

        $page = Page::where('id',$request->get('page_id'))->orderBy('id','desc')->first();
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale)
        {
            $page->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $page->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $page->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }
        $done = $page->save();
        if ($done) {
            return redirect()->back()->withInput()->with('success','تم تعديل بيانات الصفحة بنجاح' );
        }else{
            return redirect()->back()->withInput()->with('error',' عذرا حصل خطأ غير متوقع');
        }


    }

    public function page_delete($page_id)
    {
        $page = Page::where('id',$page_id)->first();
        if($page->delete()){
            return 'success';
        }
        return 'false';
    }






}
