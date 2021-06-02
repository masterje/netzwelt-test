<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
      $response = Http::get('https://netzwelt-devtest.azurewebsites.net/Territories/All');

      $tmp = $response->json();

      foreach($tmp['data'] as $row)
      {
          $map[$row['id']] = $row;
      }

      $levelTwo =[];
      foreach($map as $row)
      {
          if(isset($map[$row['parent']]))
          {
            $map[$row['parent']] ['child'][$row['id']] = $row;
            $levelTwo[$row['id']]['parent'] =  $row['parent'];

            unset($map[$row['id']]) ;
          }
      }

      foreach($map as $row)
      {
          if(isset($levelTwo[$row['parent']] ))
          {
            $levelTwoParent = $levelTwo[$row['parent']]['parent'];
            $map[$levelTwoParent]['child'][$row['parent']]['child'][$row['id']] = $row;

            $levelTwo[$row['parent']]['child'][$row['id']] =  $row['id'];

            unset($map[$row['id']]) ;
          }
      }

      return view('dashboard',['data' => $map]);
    }

}
