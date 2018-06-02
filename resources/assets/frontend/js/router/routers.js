const Main = resolve => require(['../components/common/main.vue'], resolve);
const Index = resolve => require(['../components/index/index.vue'], resolve);
export default [{
    path: '/',
    component: Main,
    children: [
        { path: 'index', component: Index, name: '文档首页' },
    ]
}];