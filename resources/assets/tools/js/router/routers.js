const Main = resolve => require(['../components/common/main.vue'], resolve);
const NotFound = resolve => require(['../components/common/404.vue'], resolve);

const chatroom = resolve => require(['../components/chatroom/index.vue'], resolve);

export default [{
    path: '/',
    component: Main,
    children: [
        { path: '404', component: NotFound, name: '404' },
    ]
}, {
    path: '/chatroom',
    component: Main,
    children: [
        { path: 'index', component: chatroom, name: '聊天室' },
    ]
}];