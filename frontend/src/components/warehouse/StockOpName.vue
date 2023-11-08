<template>
<div>
<v-card>
            <v-data-table
              :headers="headers"
              :items="items"
              sort-by="idstock"
              class="elevation-5 pa-4"
            >
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Stock Opname</v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                  <v-spacer></v-spacer>
                  <v-dialog v-model="dialog" max-width="600px">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="secondary"
                        dark
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-icon left>fas fa-plus</v-icon>
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
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idproduct"
                                label="Product Name"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                              @keypress="filter(event)"
                                v-model="editedItem.idstock"
                                label="Stock"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idsupplier"
                                label="Supplier Name"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                              @keypress="filter(event)"
                                v-model="editedItem.jumlah"
                                label="Incoming Amount"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                              @keypress="filter(event)"
                                v-model="editedItem.tanggal"
                                label="Date Of Entry"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="close">
                          Cancel
                        </v-btn>
                        <v-btn color="secondary" text @click="save">
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                  <v-dialog v-model="dialogDelete" max-width="550px">
                    <v-card>
                      <v-card-title class="text-h5"
                        >Are you sure you want to delete this
                        item?</v-card-title
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
        <div class="align-center">
    <v-menu   
    transition="slide-y-transition"
    offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon
          color="secondary"
          v-bind="attrs"
          v-on="on"
        >
          <v-icon>fas fa-ellipsis-vertical</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item @click="deleteItem(item)">
            <v-icon style="color:red;" small class="mr-2">fa-solid fa-trash</v-icon>
            <v-list-item-title>Delete</v-list-item-title>  
        </v-list-item>

        <v-list-item @click="editItem(item)">
            <v-icon style="color:orange;" small class="mr-2">fa-solid fa-pencil</v-icon>
            <v-list-item-title>Edit</v-list-item-title>
        </v-list-item>  
      </v-list>
    </v-menu>
  </div>
      </template>
            </v-data-table>
             <v-snackbar
           v-model="snackbar1"
           absolute
          top
          color="success"
          outlined
          right
          timeout= 1500
           >
            The Data Successfully Add
          </v-snackbar>
          <v-snackbar
           v-model="snackbar2"
            absolute
          top
          color="error"
          outlined
          right
          timeout = 1500
           >
            The Data Successfully Delete
          </v-snackbar>
  </v-card>
  </div>
</template>

<script>
export default {
    data: () => ({
    tab: null,
    dialog: false,  
    dialogDelete: false,
    snackbar1: false,
    snackbar2: false,
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: true,
        value: "idproduct",
      },
      { text: "Stock", value: "idstock" },
      { text: "Supplier Name", value: "idsupplier" },
      { text: "Incoming Amount", value: "jumlah" },
      { text: "Date Of Entry", value: "tanggal" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    items: [],
    editedIndex: -1,
    editedItem: {
      idproduct: "",
      idstock: "",
      idsupplier: "",
      jumlah: "",
      tanggal: "",
    },
    defaultItem: {
      idproduct: "",
      idstock: "",
      idsupplier: "",
      jumlah: "",
      tanggal: "",
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
      this.items = [
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-05",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
      ];
    },

    filter: function (evt) {
    evt = evt ? evt : window.event;
    let expect = evt.target.value.toString() + evt.key.toString();

    if (!/^[-+]?[0-9]*\.?[0-9]*$/.test(expect)) {
      evt.preventDefault();
    } else {
      return true;
    }
  },
  
    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.items.splice(this.editedIndex, 1);
      this.closeDelete();
      this.snackbar2 = true;
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
        Object.assign(this.items[this.editedIndex], this.editedItem);
      } else {
        this.items.push(this.editedItem);
      }
      this.close();
      this.snackbar1 = true;
    },
  },
}
</script>

<style>

</style>