const Main = resolve => require(['../components/common/main.vue'], resolve);
const NotFound = resolve => require(['../components/common/404.vue'], resolve);
const About = resolve => require(['../components/common/about.vue'], resolve);

const Index = resolve => require(['../components/index/index.vue'], resolve);

const articleIndex = resolve => require(['../components/article/index.vue'], resolve);
const articleDetail = resolve => require(['../components/article/detail.vue'], resolve);

const leaveIndex = resolve => require(['../components/leave/index.vue'], resolve);

export default [{
    path: '/',
    component: Main,
    children: [
        { path: 'index', component: Index, name: '博客首页' },
        { path: 'about', component: About, name: '关于' },
        { path: '404', component: NotFound, name: '404' },
    ]
}, {
    path: '/article',
    component: Main,
    children: [
        { path: 'index', component: articleIndex, name: '文章列表' },
        { path: 'detail/:id', component: articleDetail, name: '文章详情' },
    ]
}, {
    path: '/leave',
    component: Main,
    children: [
        { path: 'index', component: leaveIndex, name: '留言列表' },
    ]
}];