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

      <button type="submit" class="btn btn-primary" :disabled="isLoading">
        {{ isLoading ? "Saving..." : isEditing ? "Update" : "Save" }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { eventBus } from "../../eventBus"; // Import Event Bus

export default {
  props: {
    metaId: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      meta: { meta_key: "", value: "", post_id: null },
      isEditing: false,
      posts: [],
      isLoading: false,
    };
  },
  async created() {
    eventBus.emit("loading", true);
    try {
      await this.fetchPosts();

      if (this.metaId) {
        this.isEditing = true;
        const response = await axios.get(`/api/meta/${this.metaId}`);
        this.meta = response.data;
      }
    } catch (error) {
      console.error("Error fetching meta:", error);
    } finally {
      eventBus.emit("loading", false);
    }
  },
  methods: {
    async saveMeta() {
      eventBus.emit("loading", true);
      this.isLoading = true;
      try {
        if (this.isEditing) {
          await axios.put(`/api/meta/${this.metaId}`, this.meta);
          alert("Meta updated successfully");
        } else {
          await axios.post("/api/meta", this.meta);
          alert("Meta created successfully");
        }
        this.$router.push("/meta");
      } catch (error) {
        console.error("Error saving meta:", error);
      } finally {
        eventBus.emit("loading", false);
        this.isLoading = false;
      }
    },
    async fetchPosts() {
      const response = await axios.get("/api/posts");
      this.posts = response.data;
    },
  },
};
</script>
