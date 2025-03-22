import { createRouter, createWebHistory } from 'vue-router';
import PostList from './components/PostList.vue';
import PostForm from './components/PostForm.vue';
import CreatePost from './components/CreatePost.vue';
import EditPost from './components/EditPost.vue';

const routes = [
  { path: '/', component: PostList },
  { path: '/post/new', component: CreatePost },
  { path: '/post/edit/:id', component: EditPost, props: true }
];

export const router = createRouter({
  history: createWebHistory(),
  routes
});