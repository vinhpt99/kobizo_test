<template>
  <div>
    <h2>Post List</h2>
    <ul class="list-group">
      <li v-for="post in posts" :key="post.id" class="list-item">
        {{ post.title }}
        <router-link :to="'/post/edit/' + post.id" class="btn btn-sm btn-warning ms-2">Edit</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { posts: [] };
  },
  async mounted() {
    const response = await axios.get('/api/posts');
    this.posts = response.data;
  }
};
</script>
