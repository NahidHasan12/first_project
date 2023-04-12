<?php

namespace App\Http\Controllers;

use App\Models\Admit;
use Illuminate\Http\Request;

use App\Http\Requests\admitStudent;
use function PHPUnit\Framework\fileExists;

class admitController extends Controller
{
    public function view(){
        return view('ajax_curd/admit');
    }
    //Store Student Data
    public function store(admitStudent $request){
       //dd($request->all());
       $profile = $this->file_upload($request->file('avatar'), 'image/profile/');
        $data = Admit::create([
            'name'=>$request->name,
            'mail'=>$request->mail,
            'phone'=>$request->phone,
            'roll'=>$request->roll,
            'reg'=>$request->reg,
            'board'=>$request->board,
            'session'=>$request->session,
            'avatar'=>$profile
        ]);

        if($data){
            $output = ['status'=>'success', 'message'=>'Data Hase Been Saved Successfully'];
        }else{
            $output = ['status'=>'error', 'message'=>'Somthing Error-!'];
        }


        return response()->json($output);
    }

    //Read Student Data
    public function read(request $request){
       if($request->ajax()){
        $getData = Admit::latest('id')->get();
        $code = '';
        foreach($getData as $key=>$student){
            $SL=$key+1;
            $code.='
            <tr>
                <td>'.$SL.'</td>
                <td><img src="image/profile/'.$student->avatar.'" alt="'.$student->name.'-img" width="55px" height="50px"></td>
                <td>'.$student->name.'</td>
                <td>'.$student->mail.'</td>
                <td>'.$student->phone.'</td>
                <td>'.$student->roll.'</td>
                <td>'.$student->reg.'</td>
                <td>'.$student->board.'</td>
                <td>'.$student->session.'</td>
                <td class="d-flex justify-items-center justify-content-between">
                   <button type="button" class="btn btn-sm btn-info">View</button>
                   <button type="button" class="btn btn-sm btn-primary editData" data-id="'.$student->id.'">Edit</button>
                   <button type="button" class="btn btn-sm btn-danger deleteData" data-id="'.$student->id.'">Delete</button>
                </td>
            </tr>
          ';
        }
        return response()->json($code);
       }

    }

    //Edit Student Data
    public function edit(request $request){
        if($request->ajax()){
            $data = Admit::findOrFail($request->studentId);
            return response()->json($data);
        }

    }
    // Select Student Board Function
    public function boardSelect(request $request){
        if($request->ajax()){
            $student = Admit::findOrFail($request->studentId);
            $rajshahi = $student->board == "rajshahi" ? 'selected' : '';
            $dhaka = $student->board == "dhaka" ? 'selected' : '';
            $madrasha = $student->board == "madrasha" ? 'selected' : '';

            $output = '';
            $output .='
            <label for="board" class="form-label">Board</label>
            <select class="form-select" id="board" name="board" aria-label="Default select example">
                <option selected>Open this select Board</option>
                <option value="rajshahi"'.$rajshahi.'>Rajshahi</option>
                <option value="dhaka"'.$dhaka.'>Dhaka</option>
                <option value="madrasha"'.$madrasha.'>Madrasha</option>
            </select>
            ';
            return response()->json($output);
        }
    }
    // Select Student Session Function
    public function studentSession(request $request){
        if($request->ajax()){
            $student = Admit::findOrFail($request->studentId);
            $aa = $student->session == "2017-18" ? 'selected' : '';
            $bb = $student->session == "2018-19" ? 'selected' : '';
            $cc = $student->session == "2019-20" ? 'selected' : '';

            $output = '';
            $output .='
            <label for="session" class="form-label">Session</label>
                <select class="form-select" id="session" name="session" aria-label="Default select example">
                    <option selected>Open this select Session</option>
                    <option value="2017-18"'.$aa.'>2017-18</option>
                    <option value="2018-19"'.$bb.'>2018-19</option>
                    <option value="2019-20"'.$cc.'>2019-20</option>
                </select>
            ';
            return response()->json($output);
        }
    }
    //==========Student Data Edit End===========///

    //Student Data Update
    public function update(admitStudent $request){
        if($request->ajax()){

           // dd($request->all());
            $student = Admit::findOrFail($request->updateId);
            if($request->hasFile('avatar')){
                $profile = $this->file_updated($request->file('avatar'), 'image/profile/', $student->avatar);
            }else{
                $profile = $student->avatar;
            }

            $data = $student->update([
                'name'=>$request->name,
                'mail'=>$request->mail,
                'phone'=>$request->phone,
                'roll'=>$request->roll,
                'reg'=>$request->reg,
                'board'=>$request->board,
                'session'=>$request->session,
                'avatar'=>$profile
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Data Hase Been Updated Successfully'];
            }else{
                $output = ['status'=>'error', 'message'=>'Somthing Error-!'];
            }


            return response()->json($output);
        }
    }

    //Delete Student Data
    public function delete(request $request){
        if($request->ajax()){
            $student = Admit::findOrFail($request->studentId);
            if(fileExists('image/profile/'.$student->avatar)){
                unlink('image/profile/'.$student->avatar);
            }
            $student->delete();
            $output = ['status'=>'success','message'=>'Student Data Has Been Deleted Successfully'];
            Return response()->json($output);
        }
    }
}
