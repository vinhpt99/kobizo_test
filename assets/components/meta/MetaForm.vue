<template>
  <div class="container">
    <h2>{{ isEditing ? "Edit Meta" : "Create Meta" }}</h2>
    <form @submit.prevent="saveMeta">
      <div class="mb-3">
        <label class="form-label">Key</label>
        <input v-model="meta.meta_key" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Value</label>
        <input v-model="meta.value" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Select Post</label>
        <select v-model="meta.post_id" class="form-select" required>
          <option v-for="post in posts" :key="post.id" :value="post.id">
            {{ post.title }}
          </option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">
        {{ isEditing ? "Update" : "Save" }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {
    this.fetchPosts();
  },
  props: {
    metaId: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      meta: {
        key: "",
        value: "",
      },
      isEditing: false,
      posts: [],
    };
  },
  async created() {
    if (this.metaId) {
      this.isEditing = true;
      try {
        const response = await axios.get(`/api/meta/${this.metaId}`);
        this.meta = response.data;
      } catch (error) {
        console.error("Error fetching meta:", error);
      }
    }
  },
  methods: {
    async saveMeta() {
      try {
        if (this.isEditing) {
          await axios.put(`/api/meta/${this.metaId}`, this.meta);
          alert("Meta updated successfully");
        } else {
          await axios.post("/api/meta", this.meta);
          alert("Meta created successfully");
        }
      } catch (error) {
        console.error("Error saving meta:", error);
      }
    },
    async fetchPosts() {
      const response = await axios.get("/api/posts");
      this.posts = response.data;
    },
  },
};
</script>
