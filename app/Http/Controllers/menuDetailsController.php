<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class menuDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::where('parent_id','0')->where('type','footer')->orderby('position','asc')->get();
        return view('menus.footer',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        if($request->has('parent_id')){
            $status = $request->parent_id;
            // return $staus;
            if($status > 0){
            
                $menu = Menu::findOrFail($request->id);
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = $request->parent_id;
                
                $menu->sub = 0;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
            else{
                
                $menu = Menu::findOrFail($request->id);
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = 0;
                $menu->sub = 0;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
        }else{
            if($request->sub == 1){
                
                $menu = Menu::findOrFail($request->id); 
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = 0;
                $menu->sub = 1;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
            else{
                
                $menu = Menu::findOrFail($request->id); 
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = 0;
                $menu->sub = 0;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
        }
           
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request->all();
        $positionArr = \DB::SELECT("SELECT MAX(position) as position From menus where type = '".$request->type."' ");
        $newPosition = 0;
        foreach ($positionArr as $pos) {
            $newPosition += (int)$pos->position + 1 ;
        }
        if($request->has('confirm')){
            $status = $request->confirm;
            if($status == 1){
                $menu = new Menu;
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = $request->parent_id;
                $menu->position = $newPosition;
                if($request->has('icon')){
                    $menu->iClass = $request->icon;
                }
                $menu->sub = 0;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
            else{
                $menu = new Menu;
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = 0;
                $menu->position = $newPosition;
                $menu->sub = 0;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
            }
        }else{
            $menu = new Menu;
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->type = $request->type;
                $menu->parent_id = 0;
                $menu->position = $newPosition;
                $menu->sub = 1;
                if($menu->save()){
                    return redirect()->back();
                }
                else{
                    return "Something Went Wrong";
                }
        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
