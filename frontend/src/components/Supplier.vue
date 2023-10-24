<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="price"
      class="elevation-5 pa-4"
      style="margin-top:70px;"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Supplier</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="550px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="secondary" dark class="mb-2" v-bind="attrs" v-on="on">
                <v-icon>fas fa-plus</v-icon>
                Add
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <!-- <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.idsupplier"
                        label="ID Supplier"
                      ></v-text-field>
                    </v-col> -->
                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.name"
                          label="Name Supplier"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.telepon"
                          label="No Telepon"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.alamat"
                          label="Alamat"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" text @click="close"> Cancel </v-btn>
                <v-btn color="secondary" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="secondary" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">
          fa-solid fa-pencil
        </v-icon>
        <v-icon small @click="deleteItem(item)"> fa-solid fa-trash </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="secondary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </v-app>
</template>
<script>
export default {
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    headers: [
      // {
      //   text: "ID Supplier",
      //   align: "start",
      //   sortable: true,
      //   value: "idsupplier",
      // },
      { text: "Name Supplier", value: "name" },
      { text: "Email", value: "email" },
      { text: "No Telepon", value: "telepon" },
      { text: "Alamat", value: "alamat" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      idsupplier: "",
      name: "",
      email: "",
      telepon: "",
      alamat: "",
    },
    defaultItem: {
      idsupplier: "",
      name: "",
      email: "",
      telepon: "",
      alamat: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.desserts = [
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idsupplier: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

<style>
</style>
