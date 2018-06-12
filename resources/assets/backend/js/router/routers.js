const Main = resolve => require(['../components/common/main.vue'], resolve);
const Home = resolve => require(['../components/common/home.vue'], resolve);
const NotFound = resolve => require(['../components/common/404.vue'], resolve);
const Login = resolve => require(['../components/common/login.vue'], resolve);

const WebsiteSetting = resolve => require(['../components/website/setting.vue'], resolve);
const WebsiteMonitoring = resolve => require(['../components/website/monitoring.vue'], resolve);
const WebsiteDump = resolve => require(['../components/website/dump.vue'], resolve);

const AdminLists = resolve => require(['../components/admin/lists.vue'], resolve);
const AdminDetail = resolve => require(['../components/admin/detail.vue'], resolve);
const AdminForm = resolve => require(['../components/admin/form.vue'], resolve);
const AdminRole = resolve => require(['../components/admin/role.vue'], resolve);
const AdminRoleForm = resolve => require(['../components/admin/roleForm.vue'], resolve);
const AdminRoleDetail = resolve => require(['../components/admin/roleDetail.vue'], resolve);

const UserLists = resolve => require(['../components/user/lists.vue'], resolve);
const UserDetail = resolve => require(['../components/user/detail.vue'], resolve);
const UserDisabled = resolve => require(['../components/user/disabled.vue'], resolve);

const ArticleLists = resolve => require(['../components/article/lists.vue'], resolve);
const ArticleRecommend = resolve => require(['../components/article/recommend.vue'], resolve);
const ArticleDetail = resolve => require(['../components/article/detail.vue'], resolve);
const ArticleForm = resolve => require(['../components/article/form.vue'], resolve);
const ArticleDisabled = resolve => require(['../components/article/disabled.vue'], resolve);
const ArticleRecycle = resolve => require(['../components/article/recycle.vue'], resolve);

const LeaveLists = resolve => require(['../components/leave/lists.vue'], resolve);

export default [{
    path: '/login',
    component: Login,
    name: '登录',
    hidden: true,
}, {
    path: '/',
    redirect: '/home',
    component: Main,
    name: '容器页面',
    icon: 'ios-home',
    noDropdown: true,
    children: [
        { path: 'home', component: Home, name: '后台首页', icon: 'ios-list-outline' },
        { path: 'lists', component: AdminLists, name: '个人中心', icon: 'ios-list-outline' },
        { path: 'permission', component: Home, name: '消息中心', icon: 'ios-navigate' },
        { path: 'permission', component: Home, name: '代办事项', icon: 'ios-navigate' },
        { path: '404', component: NotFound, name: '404', icon: 'ios-navigate' },
    ]
}, {
    path: '/website',
    component: Main,
    name: '网站管理',
    meta: {id: 300},
    icon: 'settings',
    children: [
        {path: 'setting', component: WebsiteSetting, name: '网站设置', icon: 'ios-list-outline', meta: {id: 301} },
        {path: 'monitoring', component: WebsiteMonitoring, name: '网站监测', icon: 'ios-list-outline', meta: {id: 302} },
        {path: 'dump', component: WebsiteDump, name: '数据备份', icon: 'ios-navigate', meta: {id: 303} },
    ]
}, {
    path: '/admin',
    component: Main,
    name: '管理员管理',
    meta: {id: 400},
    icon: 'social-octocat',
    children: [
        {path: 'lists', component: AdminLists, name: '管理员列表', icon: 'ios-list-outline', meta: {id: 401} },
        {path: 'add', component: AdminForm, name: '新建管理员', icon: 'ios-navigate', meta: { id: 402, hidden: true } },
        {path: 'edit/:id', component: AdminForm, name: '编辑管理员', icon: 'ios-navigate', meta: { id: 403, hidden: true } },
        {path: 'detail/:id', component: AdminDetail, name: '管理员详情', icon: 'ios-navigate', meta: { id: 404, hidden: true } },
        {path: 'role', component: AdminRole, name: '角色列表', icon: 'ios-navigate', meta: {id: 405} },
        {path: 'role/add', component: AdminRoleForm, name: '新增角色', icon: 'ios-navigate', meta: { id: 406, hidden: true } },
        {path: 'role/detail/:id', component: AdminRoleDetail, name: '角色详情', icon: 'ios-navigate', meta: { id: 407, hidden: true } },
        {path: 'role/edit/:id', component: AdminRoleForm, name: '编辑角色', icon: 'ios-navigate', meta: { id: 408, hidden: true } }
    ]
}, {
    path: '/user',
    component: Main,
    name: '用户管理',
    icon: 'person',
    children: [
        {path: 'lists', component: UserLists, name: '用户列表', icon: 'ios-list-outline' },
        {path: 'detail/:id', component: UserDetail, name: '用户详情', icon: 'ios-list-outline', meta: { hidden: true } },
        {path: 'disabled', component: UserDisabled, name: '冻结用户', icon: 'ios-list-outline' }
    ]
}, {
    path: '/article',
    component: Main,
    name: '文章管理',
    icon: 'edit',
    children: [
        { path: 'lists', component: ArticleLists, name: '文章列表', icon: 'ios-list-outline' },
        // { path: 'recommend', component: ArticleRecommend, name: '推荐列表', icon: 'ios-list-outline' },
        { path: 'disabled', component: ArticleDisabled, name: '已下架', icon: 'ios-list-outline' },
        { path: 'new', component: ArticleForm, name: '新建', icon: 'ios-list-outline', meta: { hidden: true } },
        { path: 'detail/:id', component: ArticleDetail, name: '详情', icon: 'ios-list-outline', meta: { hidden: true } },
        { path: 'edit/:id', component: ArticleForm, name: '编辑', icon: 'ios-list-outline', meta: { hidden: true } },
        { path: 'recycle', component: ArticleRecycle, name: '回收站', icon: 'ios-list-outline' }
    ]
}, {
    path: '/leave',
    component: Main,
    name: '留言管理',
    icon: 'compose',
    children: [
        { path: 'lists', component: LeaveLists, name: '留言列表', icon: 'ios-list-outline' },
        { path: 'response', component: UserLists, name: '留言回复', icon: 'ios-list-outline' },
    ]
}, {
    path: '/leave',
    component: Main,
    name: '时间轴管理',
    icon: 'clock',
    children: [
        { path: 'lists', component: UserLists, name: '时间轴列表', icon: 'ios-list-outline' },
        { path: 'recommend', component: UserLists, name: '时间轴动态', icon: 'ios-list-outline' },
    ]
}, {
    path: '/leave',
    component: Main,
    name: '日志管理',
    icon: 'clipboard',
    children: [
        { path: 'lists', component: UserLists, name: '操作日志', icon: 'ios-list-outline' },
    ]
}];