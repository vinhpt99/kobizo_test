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

      <button type="submit" class="btn btn-success" :disabled="isLoading">
        {{ isLoading ? "Updating..." : "Update" }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { eventBus } from "./../../eventBus"; 

export default {
  props: ["id"],
  data() {
    return {
      post: { title: "", content: "", status: "draft" },
      isLoading: false,
    };
  },
  async mounted() {
    eventBus.emit("loading", true);
    try {
      const response = await axios.get(`/api/posts/${this.id}`);
      this.post = response.data;
    } catch (error) {
      console.error("Failed to fetch post", error);
    } finally {
      eventBus.emit("loading", false);
    }
  },
  methods: {
    async updatePost() {
      eventBus.emit("loading", true);
      try {
        await axios.put(`/api/posts/${this.id}`, this.post);
        alert("Post updated successfully");
      } catch (error) {
        console.error("Failed to update post", error);
      } finally {
        eventBus.emit("loading", false);
      }
    },
  },
};
</script>
