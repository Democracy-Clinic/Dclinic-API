import './bootstrap';


Vue.component('postSearchingComponent', require('./components/PostSearchingComponent.vue'));
Vue.component('jobSearchingComponent', require('./components/JobSearchingComponent.vue'));
Vue.component('bookSearchingComponent', require('./components/BookSearchingComponent.vue'));
Vue.component('videoSearchingComponent', require('./components/VideoSearchingComponent.vue'));
Vue.component('postShowComponent', require('./components/PostShowComponent.vue'));
Vue.component('bookShowComponent', require('./components/BookShowComponent.vue'));
Vue.component('jobShowComponent', require('./components/JobShowComponent.vue'));
Vue.component('videoShowComponent', require('./components/VideoShowComponent.vue'));
Vue.component('postCategoryComponent', require('./components/PostCategoryComponent.vue'));
Vue.component('jobCategoryComponent', require('./components/JobCategoryComponent.vue'));
Vue.component('bookCategoryComponent', require('./components/BookCategoryComponent.vue'));
Vue.component('videoCategoryComponent', require('./components/VideoCategoryComponent.vue'));
Vue.component('createCategoryComponent', require('./components/categories/CreateCategoryComponent.vue'));
Vue.component('createFeedBackComponent', require('./components/feedbacks/CreateFeedBackComponent.vue'));
Vue.component('fileBrowserComponent', require('./components/FileBrowserComponent.vue'));
// Vue.component('videoPlayerComponent', require('./components/VideoPlayerComponent.vue'));

Vue.config.devtools = true

new Vue({
    el: '#app',
});
