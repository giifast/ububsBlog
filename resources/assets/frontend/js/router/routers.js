const Main = resolve => require(['../components/common/main.vue'], resolve);
const Index = resolve => require(['../components/index/index.vue'], resolve);

const articleDetail = resolve => require(['../components/article/detail.vue'], resolve);

export default [{
    path: '/',
    component: Main,
    children: [
        { path: 'index', component: Index, name: '博客首页' },
    ]
}, {
    path: '/article',
    component: Main,
    children: [
        { path: ':id', component: articleDetail, name: '文章详情' },
    ]
}];