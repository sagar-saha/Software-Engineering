<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Session;
use App\drug;
use App\drugmart;
use App\profile;
use Illuminate\Http\Request;

class drugmrt extends Controller
{
    public function index(){
		
		return view('index');
	}
	public function pay(){
		
		return view('pay');
	}
	public function contact(){
		
		return view('contact');
	}
	public function about(){
		
		return view('about');
	}
	
	public function autocomplete(Request $request)
{
$ad=Auth::user()->name;
      $term=$request->term;
      $data=DB::table('data')->where('addby', $ad)->where('name','LIKE','%'.$term.'%')->take(10)->get();

      $results=array();


      foreach ($data as $key => $v) {

          $results[]=['value'=>$v->name];

      }

      return response()->json($results);

  }
  public function ajax_update(Request $req)
{
	$name=$req->input('name');
    $quan=$req->input('quantity');
	$price=$req->input('price');
    $ad=Auth::user()->name;
		$chk = DB::table('data')->where('addby', $ad)->where('name',$name)->value('quantity');
		$amm=$chk-$quan;
		$chkk = DB::table('data')->where('addby', $ad)->where('name',$name)->value('price');
		$pric=$price-$chkk;
		$pri=$pric*$quan;
	$this->data_update($name,$amm,$ad);
	$this->data_modify($pri,$ad);
return "success!";
}
public static function data_update($name,$amm,$ad){
	  $returnValue = DB::table('data')
->where('name', '=', $name )->where('addby', $ad)->update(['quantity'=>$amm]);
return "success";
	
  }
  
  public static function data_modify($amm,$ad){
$xx=date('d-m-Y');
$chk = DB::table('profit')->where('adby', $ad)->where('dat',$xx)->get();
if($chk->isEmpty()){
	$data=array('profit'=>$amm,'adby'=>$ad,'dat'=>$xx);
    drugmart::create($data);
	
}
else{
	$chkk = DB::table('profit')->where('adby', $ad)->where('dat',$xx)->value('profit');
	$am=$chkk+$amm;
	DB::table('profit')->where('adby', $ad)->where('dat',$xx)->update(['profit'=>$am]);
}
return "success";
	
  }
 
	 public function login(){
		
		return view('auth/login');
	}
	public function del($id){
		$ad=Auth::user()->name;
		$data = DB::table('data')->where('id', $id)->delete();
		$data = DB::table('data')->where('addby', $ad)->paginate(20);
		return view('stat',compact('data'));
	}
	public function edit($id){
		$ad=Auth::user()->name;
		$data = DB::table('data')->where('id', $id)->get();
		return view('edit',compact('data'));
	}
	public function order($id){
		$ad=Auth::user()->name;
		Session::flash('success', 'Your Order has been successfully placed');
		$data = DB::table('data')->where('addby', $ad)->paginate(20);
		return view('stat',compact('data'));
	}
	public function sell(){
		
		return view('sell');
	}
	public function add(){
		if(Auth::check()){
		return view('add');
		}
		else{
			
			return redirect('login');
		}

	}
	public function stat(){
		if(Auth::check()){
			$ad=Auth::user()->name;
		$data = DB::table('data')->where('addby', $ad)->paginate(20);
		return view('stat',compact('data'));
		}
		else{
			
			return redirect('login');
		}
		
	}
	
	public function logout(){
		Session::flush();
		return redirect('login');
		
		
	}
	
	public function search(Request $req){
		if($req->ajax())
		{
			$ad=Auth::user()->name;
			$output="";
			$data=DB::table('data')->where('name','LIKE','%'.$req->search.'%')->get();
			if($data)
			{
				foreach($data as $key => $data)
				{
					if($data->addby==$ad){
					$output.='<tr>'.
					'<td>'.$data->name.'</td>'.
					'<td>'.$data->quantity.'</td>'.
					'<td>'.$data->price.'</td>'.
					'<td>'.$data->cname.'</td>'.
				'<td><a href="edit/'.$data->id.'"class="btn btn-info btn-sm">edit</a>|<a href="del/'.$data->id.'"class="btn btn-danger btn-sm">Delete</a></td>'.
					'</tr>';
					}
					else{
						$output.='<tr>'.
					'<td>'.$data->name.'</td>'.
					'<td>'.$data->cname.'</td>'.
				'<td><a href="order/'.$data->id.'"class="btn btn-success btn-sm">Order</a></td>'.
					'</tr>';
					}
				}
				
				return Response($output);
				
			}
			
		}
		
		
	}
	public function profile(){
		$ad=Auth::user()->name;
		$chk = DB::table('profile')->where('addby', $ad)->get();
		return view('profile',compact('chk'));
	}
	public function search2($term){
		//$term = Input::get('term');
			$output="";
			$data=DB::table('data')->where('name','LIKE','%'.$term.'%')->get();
			if($data)
			{
				foreach($data as $key => $data)
				{
					$output[]=array('name' =>$data->name);
					
				}
				
				return Response::json($output);
				
			}
			
		
		
		
	}
	public function update(Request $req,$id){
		
		$pname=$req->input('product');
    $cname=$req->input('company');
    $quan=$req->input('browser');
    $buy=$req->input('buy');
    $proname=$req->input('prov');
	$number=$req->input('num');
    $ad=Auth::user()->name;
		$returnValue = DB::table('data')
->where('id', '=', $id )
->update(['name'=>$pname,'quantity'=>$quan,'cname'=>$cname,'price'=>$buy,'addby'=>$ad,'proname'=>$proname,'number'=>$number]);
Session::flash('success', 'SuccessFully Added!!');

		$data = DB::table('data')->where('addby', $ad)->paginate(20);
		return view('stat',compact('data'));
	
}
public function proupdate(Request $req){
	$name=$req->input('product');
    $cont=$req->input('company');
    $address=$req->input('comment');
    $ad=Auth::user()->name;
	$data=array('name'=>$name,'contact'=>$cont,'address'=>$address,'addby'=>$ad);
    profile::create($data);
	$chk = DB::table('profile')->where('addby', $ad)->get();
		return view('profile',compact('chk'));
}
	public function insert(Request $req){
		
    $pname=$req->input('product');
    $cname=$req->input('company');
    $quan=$req->input('browser');
    $buy=$req->input('buy');
    $proname=$req->input('prov');
	$number=$req->input('num');
    $ad=Auth::user()->name;
	
$chk = DB::table('data')->where('addby', $ad)->where('name',$pname)->get();
if($chk->isEmpty()){
	$data=array('name'=>$pname,'quantity'=>$quan,'cname'=>$cname,'price'=>$buy,'addby'=>$ad,'proname'=>$proname,'number'=>$number);
    drug::create($data);
    Session::flash('success', 'SuccessFully Added!!');
return view('add');
	
}
else{
    Session::flash('success', 'Product already exist go to product page to edit it!');
return view('add');
}


	}
}
