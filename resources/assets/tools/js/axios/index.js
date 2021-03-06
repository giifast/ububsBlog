window.axios = require('axios');
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="Authrization"]');
if (token) {
  window.axios.defaults.headers.common['X-Authrization'] = token.content;
}


//axios拦截器
axios.interceptors.request.use(function(config) {
  NProgress.start();
  return config;
}, function(error) {
  return Promise.reject(error);
});

axios.interceptors.response.use(function(response) {
  NProgress.done();
  let { status, data, message } = response.data;
  if (!status) {
    throw (message);
    return new Promise(() => {});
  }
  return response;
}, function(error) {
  return Promise.reject(error);
});