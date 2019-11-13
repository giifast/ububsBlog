const Main = resolve => require(['../components/common/main.vue'], resolve);
const NotFound = resolve => require(['../components/common/404.vue'], resolve);

const chatroomIndex = resolve => require(['../components/chatroom/index.vue'], resolve);
const chatroomShow = resolve => require(['../components/chatroom/show.vue'], resolve);

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
    { path: 'index', component: chatroomIndex, name: '聊天室' },
    { path: 'show/:id', component: chatroomShow, name: '聊天室' },
  ]
}];