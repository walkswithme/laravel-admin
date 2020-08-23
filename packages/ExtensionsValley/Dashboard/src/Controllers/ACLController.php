<?php
namespace ExtensionsValley\Dashboard;

use ExtensionsValley\Dashboard\Models\traits\DashboardTraits;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ACLController extends Controller
{

    use DashboardTraits;

    public function __construct()
    {

        $this->getNavigationBar();
        $this->getWidgets();
    }

    public function getIndex(Request $request)
    {

        $title = 'Manage User Group Privilege';

        if (\Auth::guard('admin')->user()->groups != 1) {
            return redirect('admin/dashboard')->with(['error' => 'Unauthorized action detected']);
        }
        $result = [];
        if ($request->has('id')) {
            $result = \DB::table('acl_permission')
                ->Where('group_id', $request->input('id'))
                ->get();
        }
        return \View::make('Dashboard::user.aclform', compact('title', 'result'));
    }

    /**
     * Create a new group instance after a valid registration.
     *
     * @param  array $data
     * @return group
     */
    protected function setPermission(Request $request)
    {

        $group_id = $request->input('groups_id');


        if ((int)$group_id == 0) {
            return redirect('admin/aclmanager')->with(['error' => 'Please select proper groups and permission']);
        }

       \DB::table('acl_permission')->Where('group_id', $group_id)->delete();

        ## Main Menu Privilages
        $main_menu_text = $request->input('main_menu_text');
        $main_menu_icon = $request->input('main_menu_icon');
        $main_menu_order = $request->input('main_menu_order');
        $main_menu_acl_key = $request->input('main_menu_acl_key');
        $data = [];

      /*  echo "<pre/>";
        print_r($main_menu_text);
        echo "<pre/>";
        print_r($main_menu_view);
*/
        for ($i = 0; $i < sizeof($main_menu_text); $i++) {

            $main_menu_item = !empty($request->has('main_menu_view_'.$i)) ?
                (($request->input('main_menu_view_'.$i) == 'on') ? 1 : 0)
                : 0;

            $data[] = ['group_id' => $group_id
                , 'link' => ''
                , 'icon' => $main_menu_icon[$i]
                , 'menu_text' => $main_menu_text[$i]
                , 'acl_key' => $main_menu_acl_key[$i]
                , 'ordering' => !empty($main_menu_order[$i]) ? $main_menu_order[$i] : 0
                , 'parent_menu' => 0
                , 'view' => $main_menu_item
                , 'created_at' => date("Y-m-d h:i:s")
            ];
        }

        \DB::table('acl_permission')->insert($data);
        //exit;
        ## Sub Menu Privilages
        $sub_menu_text = $request->input('sub_menu_text');
        $sub_menu_link = $request->input('sub_menu_link');
        $sub_menu_order = $request->input('sub_menu_order');
        $sub_menu_acl_key = $request->input('sub_menu_acl_key');
        $sub_menu_parent_acl_key = $request->input('sub_menu_parent_acl_key');
        $sub_menu_view = $request->input('sub_menu_view');
        $sub_menu_add = $request->input('sub_menu_add');
        $sub_menu_edit = $request->input('sub_menu_edit');
        $sub_menu_delete = $request->input('sub_menu_delete');

        $subdata = [];
        for ($i = 0; $i < sizeof($sub_menu_text); $i++) {

            $sub_menu_views = !empty($request->has('sub_menu_view_'.$i)) ?
                (($request->input('sub_menu_view_'.$i) == 'on') ? 1 : 0)
                : 0;
            $sub_menu_adds = !empty($request->has('sub_menu_add_'.$i)) ?
                (($request->input('sub_menu_add_'.$i) == 'on') ? 1 : 0)
                : 0;
            $sub_menu_edits = !empty($request->has('sub_menu_edit_'.$i)) ?
                (($request->input('sub_menu_edit_'.$i) == 'on') ? 1 : 0)
                : 0;
            $sub_menu_deleted = !empty($request->has('sub_menu_delete_'.$i)) ?
                (($request->input('sub_menu_delete_'.$i) == 'on') ? 1 : 0)
                : 0;

            $subdata[] = ['group_id' => $group_id
                , 'icon' => ''
                , 'link' => $sub_menu_link[$i]
                , 'menu_text' => $sub_menu_text[$i]
                , 'acl_key' => $sub_menu_acl_key[$i]
                , 'ordering' => !empty($sub_menu_order[$i]) ? $sub_menu_order[$i] : 0
                , 'parent_menu' => \DB::table('acl_permission')
                    ->Where('acl_key', $sub_menu_parent_acl_key[$i])
                    ->Where('group_id', $group_id)
                    ->value('id')
                , 'view' => $sub_menu_views
                , 'adding' => $sub_menu_adds
                , 'edit' => $sub_menu_edits
                , 'trash' => $sub_menu_deleted
                , 'created_at' => date("Y-m-d h:i:s")
            ];
        }

        \DB::table('acl_permission')->insert($subdata);

        return redirect('admin/aclmanager?id='.$group_id)->with(['message' => 'Permission set successfully!']);
    }

}
