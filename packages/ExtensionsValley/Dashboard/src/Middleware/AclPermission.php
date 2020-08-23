<?php

namespace ExtensionsValley\Dashboard\Middleware;

use Closure;
use Illuminate\Support\Collection;

class AclPermission
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    protected $acl;

    public function handle($request, Closure $next, $param = null)
    {


        $user_groups = \Auth::guard('admin')->user()->groups;
        $current_url = url("/").'/'.$request->path();
        $accesstoken = "";
        if (!empty($param)) {
           $action = $this->checkValidPermissions($param);
           if($request->has('accesstoken')){
                $accesstoken = base64_decode($request->input('accesstoken'));
           }else{
                return redirect()->back()->with(['error' => 'Access Token Missing!']);
                exit;
           }

           if($action === 0){
                return redirect()->route('extensionsvalley.admin.dashboard')->with(['error' => 'Invalid Permission Defined!']);
                exit;
           }
            $count = \DB::table('acl_permission')
                ->Where('group_id', $user_groups)
                ->where('acl_key', trim($accesstoken))
                ->Where($action, 1)
                ->count();
        } else {
            $count = \DB::table('acl_permission')
                ->Where('group_id', $user_groups)
                ->Where('link', $current_url)
                ->Where('view', 1)
                ->count();
        }
        if ((int)$count == 0) {
            return redirect()->route('extensionsvalley.admin.dashboard')->with(['error' => 'Access Permission Denied!']);
        }

        return $next($request);
    }

    public function checkValidPermissions($param){
         switch ($param) {
                case 'add':
                    return 'adding';
                    break;
                case 'edit':
                    return $param;
                    break;
                case 'view':
                    return $param;
                    break;
                case 'trash':
                    return $param;
                    break;
                default:
                    return 0;
                    break;
            }

    }

}
