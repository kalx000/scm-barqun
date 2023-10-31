<template>
<v-app>
      <Navbar />
    <LeftBar />
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="price"
      class="elevation-5 pa-4"
      style="margin-top:80px;"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Manage Product</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="700px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
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
                        v-model="editedItem.name"
                        label="Product name"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        @keypress="filter(event)"
                        v-model="editedItem.price"
                        label="Price"
                        prefix="Rp. "
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                      @keypress="filter(event)"
                        v-model="editedItem.qty"
                        label="Quantity"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.unit"
                        label="Unit"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.warehouse"
                        label="Warehouse"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
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
            <v-icon style="color:orange;" small class="mr-2">fa-solid fa-pen</v-icon>
            <v-list-item-title>Edit</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
      </template>
    </v-data-table>
    <Footer />
  </v-app>
</template>
<script>
import LeftBar from "@/components/LeftBar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/NavBar.vue";
export default {
  components: {
    LeftBar,
    Footer,
    Navbar,
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    items: [{ icon: "mdi-delete", text: "delete" }, { icon: "mdi-pencil" }],
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "Price", value: "price" },
      { text: "Qty", value: "qty" },
      { text: "Unit", value: "unit" },
      { text: "Warehouse", value: "warehouse" },
      // { text: 'ID Product', value: 'id' },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      price: [],
      qty: [],
      unit: [],
      warehouse: [],
      id: [],
    },
    defaultItem: {
      name: "",
      price: [],
      qty: [],
      unit: [],
      warehouse: [],
      id: [],
    },
  }),

    // name: '',
    //   nameRules: [
    //     v => !!v || 'Product name is required',
    //   ],
    // price: '',
    //   priceRules: [
    //     v => !!v || 'Price is required',
    //   ],
    // qty: '',
    //   qtyRules: [
    //     v => !!v || 'Quantity is required',
    //   ],
    // unit: '',
    //   unitRules: [
    //     v => !!v || 'Unit is required',
    //   ],
    // warehouse: '',
    //   warehouseRules: [
    //     v => !!v || 'Warehouse is required',
    //   ],

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
          name: "RJ45 Cable",
          price: 26000,
          qty: "10",
          unit: "meter",
          warehouse: "Gudang",
          id: "000",
        },
        {
          name: "RJ45 ",
          price: 66000,
          qty: "2",
          unit: "meter",
          warehouse: "Gudang",
          id: "111",
        },
        {
          name: "Cable",
          price: 25000,
          qty: "10",
          unit: "meter",
          warehouse: "Gudang",
          id: "222",
        },
        {
          name: "RJ45 Cable",
          price: 26700,
          qty: "10",
          unit: "meter",
          warehouse: "Gudang",
          id: "333",
        },
        {
          name: "RJ45 Cable",
          price: 3000,
          qty: "10",
          unit: "meter",
          warehouse: "Gudang",
          id: "444",
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

<style scoped>
.drop {
  box-shadow: 0ch 3px 3px #000000;
  z-index: 99;
  background-color: white !important;
  top: 0;
  position: absolute;
}
.drop h4 {
  font-size: 0.6rem;
  text-transform: none;
  cursor: pointer;
}


</style>