<template>
  <div class="container">
    <h2>Meta List</h2>

    <!-- Danh sách Meta -->
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Key</th>
          <th>Value</th>
          <th>Post</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="meta in metaList" :key="meta.id">
          <td>{{ meta.id }}</td>
          <td>{{ meta.meta_key }}</td>
          <td>{{ meta.value }}</td>
          <td>{{ meta.post_title }}</td>
          <td>
            <button class="btn btn-sm btn-warning" @click="editMeta(meta.id)">Edit</button>
            <!-- <button class="btn btn-sm btn-danger" @click="deleteMeta(meta.id)">Delete</button> -->
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Form để tạo hoặc chỉnh sửa Meta -->
    <MetaForm v-if="showForm" :metaId="selectedMetaId" @close="closeForm" />
  </div>
</template>

<script>
import axios from "axios";
import MetaForm from "./MetaForm.vue";
import { eventBus } from "../../eventBus"; // Import Event Bus

export default {
  components: { MetaForm },
  data() {
    return {
      metaList: [],
      selectedMetaId: null,
      showForm: false,
    };
  },
  mounted() {
    this.fetchMetaList();
  },
  methods: {
    async fetchMetaList() {
      eventBus.emit("loading", true);
      try {
        const response = await axios.get("/api/meta");
        this.metaList = response.data;
      } catch (error) {
        console.error("Error fetching meta list:", error);
      } finally {
        eventBus.emit("loading", false);
      }
    },
    editMeta(metaId) {
      this.selectedMetaId = metaId;
      this.showForm = true;
    },
    closeForm() {
      this.showForm = false;
      this.selectedMetaId = null;
      this.fetchMetaList();
    },
  },
};
</script>

<style></style>
