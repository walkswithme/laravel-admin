<?php
namespace ExtensionsValley\Dashboard;

use ExtensionsValley\Dashboard\Validators\GroupValidation;
use ExtensionsValley\Dashboard\Models\Group;
use ExtensionsValley\Dashboard\Models\traits\DashboardTraits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GroupController extends Controller
{

    use DashboardTraits;

    public function __construct()
    {

        $this->getNavigationBar();
        $this->getWidgets();
    }

    public function addGroup()
    {

        $title = 'Add New User Groups';

        return \View::make('Dashboard::user.groupform', compact('title'));
    }

    /**
     * Create a new group instance after a valid registration.
     *
     * @param  array $data
     * @return group
     */
    protected function saveGroup(Request $request)
    {

        $validation = \Validator::make($request->all(), with(new GroupValidation)->getRules());

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.addgroup',['accesstoken'=>$request->input('accesstoken')])->withErrors($validation)->withInput();
        }

        $name = $request->input('name');
        $status = $request->input('status');

        Group::create([
            'name' => $name,
            'status' => $status,
        ]);
        return redirect('admin/ExtensionsValley/dashboard/list/groups')->with(['message' => 'Details added successfully!']);
    }

    public function editGroup($id)
    {

        $title = 'Edit User Groups';
        $group = Group::findOrFail($id);
        return \View::make('Dashboard::user.groupform', compact('title', 'group'));
    }

    public function viewGroup($id)
    {

        $title = 'View User Groups';
        $group = Group::findOrFail($id);
        $viewmode = 'view';
        return \View::make('Dashboard::user.groupform', compact('title', 'group', 'viewmode'));
    }

    public function updateGroup(Request $request)
    {

        $group_id = $request->input('group_id');
        $name = $request->input('name');
        $status = $request->input('status');

        $group = Group::findOrFail($group_id);
        $validation = \Validator::make($request->only('group_id', 'name', 'status')
            , with(new GroupValidation)->getUpdateRules($group));
        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.editgroup', ['id' => $group->id,'accesstoken'=>$request->input('accesstoken')])->withErrors($validation)->withInput();
        }

        Group::Where('id', $group->id)->update(['name' => $name, 'status' => $status]);

        return redirect('admin/ExtensionsValley/dashboard/list/groups')->with(['message' => 'Details updated successfully!']);

    }

}
