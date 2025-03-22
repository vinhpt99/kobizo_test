<template>
  <div>
    <h2>Edit Post</h2>
    <form @submit.prevent="updatePost">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input v-model="post.title" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea v-model="post.content" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select v-model="post.status" class="form-select">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ["id"],
  data() {
    return { post: { title: "", content: "" } };
  },
  async mounted() {
    const response = await axios.get(`/api/posts/${this.id}`);
    this.post = response.data;
  },
  methods: {
    async updatePost() {
      await axios.put(`/api/posts/${this.id}`, this.post);
      this.$router.push('/');
    }
  }
};
</script>
