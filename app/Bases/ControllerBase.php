<?php

namespace App\Bases;

use App\Http\Controllers\UserSuccessController;
use App\Models\Success;
use App\Traits\UserSuccess;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ControllerBase extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UserSuccess;

    /**
     * Auth User.
     *
     * @var \App\Models\User
     */
    protected $authUser;

    /**
     * ControllerBase constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = Auth::user();
            View::share('authUser', $this->authUser);
            return $next($request);
        });
    }

    public function saveUserSuccess($data)
    {
        $successTitle = null;

        foreach ($data as $key => $value)
        {
            switch ($key) {
                case 'storyIsNew' && $value === true:
                    $successTitle = 'first_story_created';
                    break;
                case 'isPublished' && $value === true:
                    $successTitle = 'first_story_published';
                    break;
            }

            if (!empty($successTitle)) {
                $success = Success::where('title', $successTitle)->firstOrFail();
                return $this->addSuccess($this->authUser, $success);
            }
        }

        return [
            'success' => false,
        ];
    }
}
