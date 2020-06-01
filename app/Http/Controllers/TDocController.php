<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\TypeDoc;
use App\Metadonnee;
use App\Document;
use App\User;
use App\Liste;
use Excel;

class TDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $types = TypeDoc::all();
        $docs = Document::all();

        return view('admin.documents',['typesDoc' => $types], ['docs' => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $type = new TypeDoc();

        $type->intituleTd = $request->input('intituleT');
        $type->descriptionTd = $request->input('description');

        $str_arr_l = explode (",", $request->input('libelleM'));
        $str_arr_t = explode (",", $request->input('typeM'));
        $str_arr_lst = explode (",", $request->input('listeM')); 
        $metas = array_combine($str_arr_l, $str_arr_t);
        $metasLst = array_combine($str_arr_l, $str_arr_lst);
        
         $type->save();
        $i=0; $excel = null;
         foreach ( array_keys($metas) as $meta) {
             if($meta != '')
             {
                 $metadonnee = new Metadonnee();

                $metadonnee->libelleM = $meta;
                $metadonnee->typeM= array_values($metas)[$i];
                $metadonnee->m_idTd = $type->idTd;
                $metadonnee->save();

                if(array_values($metasLst)[$i] != '' && $request->file(array_values($metasLst)[$i]))
                {
                    $excel = $request->file(array_values($metasLst)[$i])->getRealPath();

                    $data= Excel::load($excel)->get();

                    if($data->count() > 0)
                    {
                        foreach($data->toArray() as $key => $value)
                        {
                            $j=0; 
                            foreach($value as $row)
                                { 
                                    $tab[$j]=$row; $j++;   
                                }
                            $insert_data[] = array(
                                'libelleL' => $tab[0],
                                'l_idM' => $metadonnee->idM
                            );
                        }

                        if(!empty($insert_data))
                        {
                            DB::table('listes')->insert($insert_data);
                            $insert_data = null;
                        }
                    }
                    
                }
                    
                $i++;
             }
                
        } 
              
        return response()->json(['success' => "created" , 'type' => $type , 'metas' => $type->metadonnees]); 
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
