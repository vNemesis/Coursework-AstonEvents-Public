<?php

namespace  App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class AccountController extends Controller
{
   /* ---------------------------------------------\
  | GET - Display all events by user               |
  \----------------------------------------------*/
  public function alleventsByUser(Request $request)
  {

    if(Auth::check())
    {
      $personalEvents = Event::all();

      $newPersonalEvents = [];

      $j=0;
      for ($i=0; $i < count($personalEvents); $i++) {
        if ($personalEvents[$i]->organiserid == auth()->user()->id)
        {
          $newPersonalEvents[$j] = $personalEvents[$i];

          $eventDate = new Carbon(date("y-m-d H:i:s",strtotime($personalEvents[$i]->datetime)));

          if($eventDate->isPast())
          {
            $newPersonalEvents[$j]->datetime = $eventDate->toDayDateTimeString();
            $newPersonalEvents[$j]->badge = "badge badge-danger";
            $newPersonalEvents[$j]->badgeVisible = "";
          }
          else
          {
            $newPersonalEvents[$j]->datetime = $eventDate->toDayDateTimeString();
            $newPersonalEvents[$j]->badge = "";
            $newPersonalEvents[$j]->badgeVisible = "hidden";
          }

          $j++;
        }
      }
    }
    else {
      $newPersonalEvents = [];
    }

    // Get current page form url e.x. &page=1
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    // Create a new Laravel collection from the array data
    $itemCollection = collect($newPersonalEvents);
    // Define how many items we want to be visible in each page
    $perPage = 6;
    // Slice the collection to get the items to display in current page
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    // Create our paginator and pass it to the view
    $newPersonalEvents = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
    // set url path for generted links
    $newPersonalEvents->setPath($request->url());

    return view('myaccount', array('newPersonalEvents'=>$newPersonalEvents));
  }
  // ==============================================




   /* ---------------------------------------------\
  | POST - Update user basic information           |
  \----------------------------------------------*/
  public function updateAccountInfo(Request $request)
  {
    $user = Auth::user();

    $this->validate($request,[

      'name' => 'string|max:255',
      'email' => 'string|email|max:255|unique:users,email,'.$user->id,
      'phone' => 'string|max:11',
    ]);

    if ($request['name'])
    {
      $user->name = $request['name'];
    }

    if ($request['email'])
    {
      $user->email = $request['email'];
    }

    if ($request['phone'])
    {
      $user->phone = $request['phone'];
    }

    $user->save();
    return redirect('myaccount')->with('flag',3);
  }
  // ==============================================




   /* ---------------------------------------------\
  | POST - Update user password                    |
  \----------------------------------------------*/
  protected function postChangePassword(Request $request)
  {
    $this->validate($request,[

      'password' => 'required|string',
      'password' => 'required|string|min:6|confirmed',
    ]);

      $user = Auth::user();
      $current_password = $request['current_password'];
      $password = bcrypt($request['password']);

      $user_count = User::all()->where('id','=',$user->id)->count();

      if (Hash::check($current_password, $user->password) && $user_count == 1)
      {
          $user->password = $password;
          try
          {
              $user->save();
              $flag = TRUE;
          }
          catch(\Exception $e)
          {
              $flag = FALSE;
          }

          if($flag)
          {
              return redirect('myaccount')->with('flag',3);
          }
          else
          {
              return redirect('myaccount')->with("flag",4);
          }
      }
      else
      {
          return redirect('myaccount')->with("flag",5);
      }
  }
}
