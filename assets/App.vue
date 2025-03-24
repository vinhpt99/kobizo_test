<template>
  <div class="container">
    <div v-if="isLoading" class="loading-container">
      <span class="spinner-border text-primary" role="status"></span>
    </div>

    <nav v-else-if="isAuthenticated" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/post" class="nav-link">Post List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/post/new" class="nav-link">Create Post</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/meta" class="nav-link">Meta List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/meta/new" class="nav-link">Create Meta</router-link>
            </li>
            <li class="nav-item" style="display: flex; align-items: center;">
              <a href="/rss-reader">Rss Reader</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<script>
import apiClient from "./auth";
import { eventBus } from "./eventBus";

export default {
  name: "App",
  data() {
    return {
      isAuthenticated: false,
      isLoading: true,
    };
  },
  mounted() {
    this.checkAuth();
    // Lắng nghe sự kiện loading từ eventBus
    eventBus.on("loading", (status) => {
      this.isLoading = status;
    });
  },
  beforeUnmount() {
    eventBus.off("loading");
  },
  methods: {
    async checkAuth() {
      try {
        eventBus.emit("loading", true);
        await apiClient.get("/check-auth");
        this.isAuthenticated = true;
      } catch (error) {
        this.isAuthenticated = false;
      } finally {
        eventBus.emit("loading", false);
      }
    },
  },
};
</script>

<style>
.loading-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
</style>
