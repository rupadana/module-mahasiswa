<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">
          {{ trans("mahasiswas.title.mahasiswas") }}
        </h3>
      </div>
      <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">
              {{ trans("core.breadcrumb.home") }}
            </a>
          </li>
          <li class="breadcrumb-item">
            {{ trans("mahasiswas.title.mahasiswas") }}
          </li>
        </ol>
      </div>
    </div>

    <div class="container">
      <div class="card">
        <div class="card-header">
          {{ trans("mahasiswas.title.mahasiswas") }}
        </div>
        <div class="card-body">
          <div class="sc-table">
            <div class="tool-bar row" style="padding-bottom: 20px;">
              <div class="actions col-12">
                <router-link :to="{ name: 'admin.mahasiswa.mahasiswa.create' }">
                  <el-button type="primary" size="small"
                    ><i class="el-icon-edit"></i>
                    {{ trans("mahasiswas.button.create mahasiswa") }}
                  </el-button>
                </router-link>
              </div>
              <div class="search col-12 py-2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <el-input
                      prefix-icon="el-icon-search"
                      size="small"
                      @keyup.enter.native="queryServer"
                      v-model="searchQuery"
                      :placeholder="
                        trans('mahasiswas.placeholder.cari mahasiswa')
                      "
                    >
                      <!-- @keyup.native="performSearch" -->
                      <template slot="append">
                        <el-button size="small" @click="queryServer">
                          <span class="fa fa-search"></span>
                        </el-button>
                      </template>
                    </el-input>
                  </div>
                </div>
              </div>
            </div>

            <el-table
              :data="data"
              stripe
              style="width: 100%"
              ref="pageTable"
              v-loading.body="tableIsLoading"
              @sort-change="handleSortChange"
            >
              <!--  <el-table-column prop="id" label="No" width="75" >
                                <template slot-scope="scope">
                                    <div :load="loadConsole(scope)">{{(meta.per_page * (meta.current_page - 1)) + scope.$index+1}}</div>
                                </template>
                            </el-table-column> -->
              <el-table-column
                :index="indexMethod"
                type="index"
                prop="no"
                label="No"
                sortable="custom"
                width="75"
              >
              </el-table-column>
              <el-table-column
                prop="nama"
                :label="trans('mahasiswas.form.name')"
                sortable="custom"
              >
                <template slot-scope="scope">
                  <a @click.prevent="goToEdit(scope)" href="#">
                    {{ scope.row.nama }}
                  </a>
                </template>
              </el-table-column>
              <el-table-column
                prop="nim"
                :label="trans('mahasiswas.form.nim')"
                sortable="custom"
              >
                <template slot-scope="scope">
                  <a @click.prevent="goToEdit(scope)" href="#">
                    {{ scope.row.nim }}
                  </a>
                </template>
              </el-table-column>
              <el-table-column
                prop="email"
                :label="trans('mahasiswas.form.email')"
                sortable="custom"
              >
                <template slot-scope="scope">
                  <a @click.prevent="goToEdit(scope)" href="#">
                    {{ scope.row.email }}
                  </a>
                </template>
              </el-table-column>
              <el-table-column
                prop="jurusan"
                :label="trans('mahasiswas.form.jurusan')"
                sortable="custom"
              >
                <template slot-scope="scope">
                  <a @click.prevent="goToEdit(scope)" href="#">
                    {{ scope.row.jurusan }}
                  </a>
                </template>
              </el-table-column>
              <el-table-column
                prop="created_at"
                :label="trans('core.table.created at')"
                sortable="custom"
              >
              </el-table-column>
              <el-table-column
                prop="actions"
                :label="trans('core.table.actions')"
              >
                <template slot-scope="scope">
                  <el-button-group>
                    <edit-button
                      :to="{
                        name: 'admin.mahasiswa.mahasiswa.edit',
                        params: { mahasiswa: scope.row.id },
                      }"
                    ></edit-button>
                    <delete-button :scope="scope" :rows="data"></delete-button>
                  </el-button-group>
                </template>
              </el-table-column>
            </el-table>
            <div
              class="pagination-wrap"
              style="text-align: center; padding-top: 20px;"
            >
              <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page.sync="meta.current_page"
                :page-sizes="[10, 20, 50, 100]"
                :page-size="parseInt(meta.per_page)"
                layout="total, sizes, prev, pager, next, jumper"
                :total="meta.total"
              >
              </el-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      data: [],
      meta: {
        current_page: 1,
        per_page: 10,
      },
      order_meta: {
        order_by: "",
        order: "",
      },
      links: {},
      searchQuery: "",
      tableIsLoading: false,
    };
  },
  methods: {
    handleSortChange(event) {
      console.log("sorting", event);
      this.tableIsLoading = true;
      this.queryServer({
        order_by: event.prop,
        order: event.order,
      });
    },
    handleSizeChange(event) {
      console.log(`per page :${event}`);
      this.tableIsLoading = true;
      this.queryServer({
        per_page: event,
      });
    },
    handleCurrentChange(event) {
      console.log(`current page :${event}`);
      this.tableIsLoading = true;
      this.queryServer({
        page: event,
      });
    },
    queryServer(customProperties) {
      this.tableIsLoading = true;
      const properties = {
        page: this.meta.current_page,
        per_page: this.meta.per_page,
        order_by: this.order_meta.order_by,
        order: this.order_meta.order,
        search: this.searchQuery,
        ...customProperties,
      };
      axios
        .get(route("mahasiswa.mahasiswas.index", properties))
        .then((response) => {
          this.tableIsLoading = false;
          if (typeof response !== "undefined") {
            this.tableIsLoading = false;
            this.data = response.data.data;
            this.meta = response.data.meta;
            this.links = response.data.links;
            this.order_meta.order_by = properties.order_by;
            this.order_meta.order = properties.order;
            console.log(response.data);
          }
        });
    },
    indexMethod(index) {
      return (this.meta.current_page - 1) * this.meta.per_page + index + 1;
    },
    goToEdit(scope) {
      this.$router.push({
        name: "admin.mahasiswa.mahasiswa.edit",
        params: {
          mahasiswa: scope.row.id,
        },
      });
    },
  },
  mounted() {
    this.queryServer();
  },
};
</script>

<style></style>
