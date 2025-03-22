<template>
  <div class="container">
    <h2>{{ isEditMode ? "Edit Post" : "Create Post" }}</h2>
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

      <button type="submit" class="btn btn-primary">
        {{ isEditMode ? "Update" : "Save" }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      post: {
        id: null,
        title: "",
        content: "",
        status: "draft",
      },
    };
  },
  computed: {
    isEditMode() {
      return !!this.post.id;
    },
  },
  async mounted() {
    const postId = this.$route.params.id;
    if (postId) {
      this.fetchPost(postId);
    }
  },
  methods: {
    async fetchPost(id) {
      console.log("aaaaaa>>", id)
      try {
        const response = await axios.get(`/api/posts/${id}`);
        this.post = response.data;
      } catch (error) {
        console.error("Error fetching post:", error);
      }
    },
    async submitPost() {
      try {
        if (this.isEditMode) {
          await axios.put(`/api/posts/${this.post.id}`, this.post);
          alert("Post updated successfully!");
        } else {
          const response = await axios.post("/api/posts", this.post);
          alert("Post created with ID: " + response.data.id);
        }
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
