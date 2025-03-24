<template>
  <div>
    <h2>Create Post</h2>
    <form @submit.prevent="submitPost">
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

      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import { eventBus } from "./../../eventBus"; 

export default {
  data() {
    return {
      post: { title: "", content: "" }
    };
  },
  methods: {
    async submitPost() {
      eventBus.emit("loading", true);
      await axios.post('/api/posts', this.post);
      eventBus.emit("loading", false);
      alert("Post created successfully");
    }
  }
};
</script>
