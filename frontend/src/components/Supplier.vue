<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="items"
      sort-by="price"
      class="elevation-5 pa-4"
      style="margin-top: 70px"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Supplier</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="550px">
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
                    <v-col cols="6">
                      <v-text-field
                        v-model="editedItem.name"
                        label="Supplier Name"
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
                        @keypress="filter(event)"
                        v-model="editedItem.telepon"
                        label="Phone Number"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        v-model="editedItem.alamat"
                        label="Address"
                      ></v-text-field>
                    </v-col>
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
              <v-card-title class="text-h5">
                Are you sure you want to delete this item?
              </v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" text @click="closeDelete">
                  Cancel
                </v-btn>
                <v-btn color="secondary" text @click="deleteItemConfirm">
                  OK
                </v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <div class="align-center">
          <v-menu transition="slide-y-transition" offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn icon color="secondary" v-bind="attrs" v-on="on">
                <v-icon>fas fa-ellipsis-vertical</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="deleteItem(item)">
                <v-icon style="color: red" small class="mr-2">fas fa-trash</v-icon>
                <v-list-item-title>Delete</v-list-item-title>
              </v-list-item>
              <v-list-item @click="editItem(item)">
                <v-icon style="color: orange" small class="mr-2">fas fa-pen</v-icon>
                <v-list-item-title>Edit</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
      </template>
    </v-data-table>
  </v-app>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      formTitle: '',
      editedItem: {},
      icons: [{ icon: "mdi-delete", text: "delete" }, { icon: "mdi-pencil" }],
      headers: [
        // Tentukan header sesuai kebutuhan Anda
        { text: 'Supplier Name', value: 'nama_supplier' },
        { text: 'Email', value: 'email' },
        { text: 'Phone Number', value: 'nomor_telepon' },
        { text: 'Address', value: 'alamat' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      items: [
        // Inisialisasi data atau dapat diambil dari API
        // { name: 'Supplier 1', email: 'supplier1@example.com', telepon: '123456789', alamat: 'Address 1' },
        // { name: 'Supplier 2', email: 'supplier2@example.com', telepon: '987654321', alamat: 'Address 2' },
      ],
    };
  },
  methods: {
    editItem(item) {
      // Buka dialog edit
      this.formTitle = 'Edit Supplier';
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      // Buka dialog konfirmasi penghapusan
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      // Hapus item dari daftar
      const index = this.items.indexOf(this.editedItem);
      this.items.splice(index, 1);

      // Tutup dialog konfirmasi penghapusan
      this.closeDelete();
    },
    save() {
      // Simpan atau perbarui item
      if (this.formTitle === 'Add Supplier') {
        this.items.push(Object.assign({}, this.editedItem));
      } else {
        // Perbarui item yang sudah ada
        const index = this.items.indexOf(this.editedItem);
        this.items.splice(index, Object.assign({}, this.editedItem));
      }

      // Tutup dialog
      this.close();
    },
    close() {
      // Tutup dialog
      this.dialog = false;
      this.clearEditedItem();
    },
    closeDelete() {
      // Tutup dialog konfirmasi penghapusan
      this.dialogDelete = false;
      this.clearEditedItem();
    },
    clearEditedItem() {
      // Bersihkan editedItem untuk persiapan berikutnya
      this.editedItem = {};
    },
    filter(event) {
      // Metode filter jika diperlukan
      // Misalnya, validasi nomor telepon hanya menerima angka
      const charCode = event.which ? event.which : event.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
      }
    },

    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

    async save() {
  try {
    const headers = {
      Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
      'Content-Type': 'application/json',
    };

    console.log('Form Title:', this.formTitle);
    console.log('Edited Item:', this.editedItem);

    if (this.formTitle === 'Add Supplier') {
      console.log('Sending POST request...');
      await axios.post('http://127.0.0.1:8081/api/supplier', this.editedItem, { headers });
    } else {
      console.log('Sending PUT request...');
      await axios.put(`http://127.0.0.1:8081/api/supplier/${this.editedItem.id}`, this.editedItem, { headers });
    }

    console.log('Request successful!');
  } catch (error) {
    console.error('Error saving data:', error);
  }
},  

  async deleteItem(item) {
    try {
      const headers = {
        Authorization: "Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4",
      };

      await axios.delete(`http://127.0.0.1:8081/api/supplier/${item.id}`, { headers });

      // Call fetchData after the delete operation is successful
      await this.fetchData();

      this.closeDelete();
    } catch (error) {
      console.error('Error deleting item:', error);
    }
  },

  async fetchData() {
    try {
      const headers = {
        Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
      };

      const response = await axios.get('http://127.0.0.1:8081/api/supplier', { headers });
      this.items = response.data.data;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  },
  },
  mounted() {
    this.fetchData();
  },
};
</script>
