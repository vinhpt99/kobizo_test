<template>
  <div>
    <h2>Post List</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Meta Key</th>
          <th>Meta Value</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="post in posts" :key="post.id">
          <template v-if="post.metas.length">
            <tr v-for="(meta, index) in post.metas" :key="meta.id">
              <td v-if="index === 0" :rowspan="post.metas.length">{{ post.title }}</td>
              <td>{{ meta.key }}</td>
              <td>{{ meta.value }}</td>
              <td v-if="index === 0" :rowspan="post.metas.length">
                <router-link :to="'/post/edit/' + post.id" class="btn btn-sm btn-warning ms-2">Edit</router-link>
              </td>
            </tr>
          </template>
          <tr v-else>
            <td>{{ post.title }}</td>
            <td colspan="2">No Meta Data</td>
            <td>
              <router-link :to="'/post/edit/' + post.id" class="btn btn-sm btn-warning ms-2">Edit</router-link>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
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
