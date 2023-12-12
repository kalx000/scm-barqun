<template>
<div>
    <Navbar />
    <v-row justify="center">

  <v-card-text class="ma-4" style="width:400px" align="center" elevation="7">
     <v-avatar class="mt-2"
  color="primary"
  size="114"
>
  <img :src="preview"/>
</v-avatar>
<label for="my-file">
<v-btn 
    @click="openFileInput"
    class="ml-n10 mt-15"
    elevation="2"
    fab
    small
    bottom
    overlap
    color="secondary"
><v-icon>mdi-camera-outline</v-icon></v-btn>
</label>
<h4 class="pt-0 mb-3  ">Fransiscus</h4>
    <v-dialog
      v-model="dialog"
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="secondary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Edit Profile
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">User Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
             
              <v-col cols="12">
                <v-text-field
                  v-model="editedItem.name"
                  label="Name"
                  prepend-icon= "mdi-account-outline"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="editedItem.phone"
                  label="Phone"
                  prepend-icon= "mdi-phone-dial-outline"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="editedItem.email"
                  label="Email"
                  prepend-icon= "mdi-email-outline"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="editedItem.password"
                  label="Password"
                  type="password"
                  prepend-icon= "mdi-lock-outline"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="close"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="close"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
 <input type="file" accept="image/*" @change="previewImage" class="inputImage form-control-file" id="my-file">
 <v-card ref="form">
        
      </v-card>
  </v-card-text>
    </v-row>

</div>
</template>

<script>
import Navbar from "../components/NavBar.vue"
export default {
  components: {
    Navbar,
  },
   data: () => ({
      dialog: false,
      preview: "bongo.gif",
      image: null,
      preview_list: [],
      image_list: [],

      editedItem: {
      name: "",
      phone: "",  
      email: "",
      password: "",
    },
    }),
  methods: {
     openFileInput() {
    document.getElementById('my-file').click(); // Trigger the file input's click event
  } ,
      previewImage: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview = e.target.result;
        }
        this.image=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },

    close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
        })
      },
},
};
</script>

<style>
.inputImage{
    display: none;
}
</style>
