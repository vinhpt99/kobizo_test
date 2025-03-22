import { createRouter, createWebHistory } from 'vue-router';
import MetaForm from './components/meta/MetaForm.vue';
import PostList from './components/post/PostList.vue';
import CreatePost from './components/post/CreatePost.vue';
import EditPost from './components/post/EditPost.vue';
import MetaList from './components/meta/MetaList.vue';

const routes = [
  { path: '/post', component: PostList },
  { path: '/post/new', component: CreatePost },
  { path: '/post/edit/:id', component: EditPost, props: true },
  { path: "/meta/new", component: MetaForm },
  { path: "/meta/edit/:id", component: MetaForm, props: true },
  { path: "/meta", component: MetaList },
];

export const router = createRouter({
  history: createWebHistory(),
  routes
});