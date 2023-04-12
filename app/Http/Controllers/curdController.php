<?php

namespace App\Http\Controllers;

use Nette\Utils\Json;
use App\Models\CurdModel;
use Illuminate\Http\Request;
use App\Http\Requests\CurdRequest;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\fileExists;

class curdController extends Controller
{
    public function view(){
        return view('curd.curd');
    }

    public function store(CurdRequest $request){

       $profile = $this->file_upload($request->file('img'),'image/curdImg/');
       $data= CurdModel::create([
            'name'       => $request->name,
            'roll'       => $request->roll,
            'reg'        => $request->reg,
            'department' => $request->department,
            'number'     => $request->number,
            'mail'       => $request->mail,
            'img'        => $profile,
        ]);
        if($data){
            $output = ['status'=>'success', 'message'=>'Data has been saved successfully'];
        }else{
            $output = ['status'=>'error', 'message'=>'Something error--!!'];
        }
        return response()->json($output);
    }

    public function read(request $request){
        if($request->ajax()){
            $getData = CurdModel::latest('id')->get();
            $code = "";
            foreach($getData as $key=>$data){
              $SL = $key+1;
              $code.='
              <tr>
                    <td>'.$SL.'</td>
                    <td><img src="image/curdImg/'.$data->img.'" alt="'.$data->name.'-image" width="55px" height="50px"></td>
                    <td>'.$data->name.'</td>
                    <td>'.$data->roll.'</td>
                    <td>'.$data->reg.'</td>
                    <td>'.$data->department.'</td>
                    <td>'.$data->number.'</td>
                    <td>'.$data->mail.'</td>
                    <td class="d-fles">
                      <button class="btn btn-sm btn-success">View</button>
                      <button class="btn btn-sm btn-info editPost" data-id="'.$data->id.'">Edit</button>
                      <button class="btn btn-sm btn-danger deletePost" data-id="'.$data->id.'">Delete</button>
                    </td>
              </tr>
              ';
            }
            return response()->json($code);
        }
    }

    public function edit(Request $request){
       if($request->ajax()){
        $data = CurdModel::findOrFail($request->postId);
        return response()->json($data);

       }
    }
    public function selectDpt(request $request){
        if($request->ajax()){
            $data = CurdModel::findOrFail($request->postId);
            $textile = $data->department == 'textile' ? 'selected' : '';
            $civil = $data->department == 'civil' ? 'selected' : '';
            $computer = $data->department == 'computer' ? 'selected' : '';
            $gdpm = $data->department == 'gdpm' ? 'selected' : '';
            $electrical = $data->department == 'electrical' ? 'selected' : '';
            $code = '';
            $code.='
            <label for="department" class="form-label">Department</label>
            <select name="department" id="department" class="form-select">
                <option selected value="">Please Select Department</option>
                <option value="textile" '.$textile.'>Textile</option>
                <option value="civil" '.$civil.'>Civil</option>
                <option value="computer" '.$computer.'>Computer</option>
                <option value="gdpm" '.$gdpm.'>GDPM</option>
                <option value="electrical" '.$electrical.'>Electrical</option>
            </select>
            ';
            return response()->json($code);
        }
    }

    public function update(CurdRequest $request){
       if($request->ajax()){
        $post = CurdModel::findOrFail($request->editId);
        if($request->hasFile('img')){
            $img = $this->file_updated($request->file('img'),'image/curdImg/',$post->img);
        }else{
            $img = $post->img;
        }
        $data = $post->update([
            'name'=>$request->name,
            'roll'=>$request->roll,
            'reg'=>$request->reg,
            'department'=>$request->department,
            'number'=>$request->number,
            'mail'=>$request->mail,
            'mail'=>$request->mail,
            'img'=>$img,
        ]);
        if($data){
            $output = ['status'=>'success','message'=>'Data has been updated successfully'];
        }else{
            $output = ['status'=>'error','message'=>'Something error'];
        }
        return response()->Json($output);
       }
    }

    public function delete(request $request){
        if($request->ajax()){
            $post = CurdModel::findOrFail($request->postId);
            if(fileExists('image/curdImg/'.$post->img)){
                unlink('image/curdImg/'.$post->img);
            }
            $post->delete();
            $output = ['status'=>'success','message'=>'Student Data Has Been Deleted Successfully'];
            Return response()->json($output);
        }
    }
}
