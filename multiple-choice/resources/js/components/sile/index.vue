<template>
	<div>
<!-- 		<v-carousel hide-delimiters>
		    <v-carousel-item
		      v-for="(item,i) in items"
		      :key="i"
		      :src="item.src"
		    ></v-carousel-item>
  		</v-carousel> -->
      <!-- <img src="https://drive.google.com/uc?id=1l86tV5RmbKMOnYsc8ZDXAr8ebUZAJZoM" width="120" height="200"> -->
      <!-- <button type="button" @click="click()">123</button><br> -->
      
      <!-- <div v-for="pp in result">
          <p v-html="pp.description"></p>
      </div> -->


      <div class="col-sm-12">
          <input type="file" ref="file" name="file" class="form-control-file" @change="setFileName()">
      </div>
      
      <!-- <loading :is-loading="isLoading"></loading>  -->
     
      <!-- quillEditor -->
        <div id="pageEditor">
          <v-container grid-list-xl fluid>
            <v-layout row wrap>
              <v-flex sm12>
                <h3 class="pa-0">Awesome Quill Editor &nbsp;&nbsp;<a href="https://quilljs.com">Offical Website</a></h3>
              </v-flex>
               <v-flex sm12>
                  <v-text-field
                  label="Title"
                  v-model="title"
                  :rules="[rules.required]"
                  ></v-text-field>
              </v-flex>
              <v-flex sm12>
                <quill-editor 
                  ref="myEditor" 
                  class="quill"
                   v-model="content"
                  :options="editorOption"
                >
                </quill-editor>      
              </v-flex>
            </v-layout>
          </v-container>
        </div>
      <!-- end quillEditor -->
      <v-btn depressed small color="primary" @click="test()">Submit</v-btn>
       <v-snackbar v-model="snack" :timeout="4000" :color="snackColor" right top>
      {{ snackText }}
      <v-btn flat @click="snack = false">Close</v-btn>
    </v-snackbar>

    <!-- v-dialog -->
    <v-dialog
      v-model="dialog"
      max-width="400"
    >
      <v-card>
        <v-card-title class="headline">
        <v-btn-toggle>
          <v-btn flat class="button-style" @click="openDialog2">
            <v-icon class="style-icon">folder</v-icon>
            &nbsp; Add Folder
          </v-btn>
      </v-btn-toggle>
      </v-card-title>

        <v-card-text>
            <v-radio-group v-model="radios">
              <div slot="label">Select Folder <strong>save image</strong></div>
              <div v-for="folder in folders">
              <v-radio v-bind:value="folder.filename">
                <div slot="label"><v-icon class="style-icon">folder</v-icon> <strong class="success--text">{{folder.filename}}</strong></div>
              </v-radio>
              </div>
            </v-radio-group>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="choose()"
          >
            Disagree
          </v-btn>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="dialog = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- v-dialog 2 -->
        <v-dialog v-model="dialog3" max-width="400px">
        <v-card>
          <v-card-title>
            <span class="style_span">Folder Name: </span>
            <v-flex xs12 sm6 md3>
            <input type="text" name="folder_name" class="form-control" v-model="folder_name">
        </v-flex>
            <v-spacer></v-spacer>
          </v-card-title>
          <v-card-actions>
           <v-spacer></v-spacer>
            <v-btn color="primary" flat @click="createFolder()">Create</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

	</div>
</template>

<script>
import { get,del,post } from '../../helpers/index.js'
import config from '../../config/index.js'
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';
import { quillEditor } from 'vue-quill-editor';

import Quill from 'quill'

import { ImageDrop } from 'quill-image-drop-module'

window.Quill = Quill



Quill.register('modules/imageDrop', ImageDrop)

// import Quill from 'quill';
// import { ImageResize } from 'quill-image-resize-module';

// Quill.register('modules/imageResize', ImageResize);

export default {

  name: 'Slide',

  data () {
    return {
    	items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg'
          }
        ],
        // isLoading: true
        result:{},
        file_name:'',
        content: '',
        title:'',
        editorOption: {
          modules: {
           toolbar: {
            container: [
              ['bold', 'italic', 'underline', 'strike'],
              [{ 'list': 'ordered'}, { 'list': 'bullet' }],
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'font': [] }],
              [{ 'align': [] }],
              ['link', 'image'],
              ['clean']
            ],
            handlers: {
              image: this.imageHandler
            }
           },
            imageResize: true,
          }
        },
        rules: {
          required: value => !!value || 'Required.',        
        },
        snack: false,
        snackColor: '',
        snackText: '',
        dialog: false,
        dialog3:false,
        folder_name:'',
        folders:{},
        radios:''
    }
  },
  created(){
    // this.isLoading = true
    this.fetchData()
    this.getFolderGoogle()

  },
  components: {
        // Loading
        quillEditor
  },
  methods:{
    click() { 
      // this.$root.$emit('show', true)
      console.log(this.content)
    },
    setFileName(){
          this.file_name = this.$refs.file.files[0];
    },
    test(){
        console.log(config.API_URL+'proposals')
        let formData = new FormData();
            formData.append('title', this.title)
            formData.append('image', this.file_name)
            formData.append('description', this.content)
            
        post(config.API_URL+'products',formData)
          .then((res) => {
                  if(res.data && res.data.success){
                      // this.loading = false
                      this.snack = true
                      this.snackColor = 'success'
                      this.snackText = 'Data success'
                  }else{
                    if(err.response.status === 404){
                      this.snack = true
                      this.snackColor = 'error'
                      this.snackText = 'Data error'
                      }
                    }
                })
          .catch((err) => {
                  if(err.response.status === 404){
                      this.snack = true
                      this.snackColor = 'error'
                      this.snackText = 'Data error'
                  }
                })
        // console.log(this.formData)
    },
    fetchData(){
        get(config.API_URL+'products')
        .then((res) => {
          console.log(res.data.data)
          this.result = res.data.data
        })
    },
    imageHandler(){
        this.dialog = true
      // const input = document.createElement('input');
      // // const newWindow = openWindow('', 'login')
      // input.setAttribute('type', 'file');
      // input.click();

      // input.onchange = () => {
      //   const file = input.files[0];

      //   // file type is only image.
      //   if (/^image\//.test(file.type)) {
      //     this.saveToServer(file);
      //   } else {
      //     console.warn('You could only upload images.')
      //   }
      // }
    },
    saveToServer(e){
      this.$root.$emit('show', true)
      let formData = new FormData();
            formData.append('image', e)
            formData.append('path', this.radios)
            ///upload/image
      post(config.API_URL+'upload/image',formData)
       .then((res) => {
              if(res.data){
                  const url = res.data.link
                  this.insertToEditor(url)
                  this.$root.$emit('show', false)
              }
            })
          .catch((err) => {
                  console.log(err)
                })   

    },

    insertToEditor(url) {
      // console.log(url)
      const range = this.$refs.myEditor.quill.getSelection()
      // console.log(range)
      this.$refs.myEditor.quill.insertEmbed(range.index, 'image', `${url}`);
      this.dialog = false
    },

    openDialog2(){
      this.dialog3 = true
    },

    createFolder(){
      let url = config.API_URL+'create-folder?folder_name='+this.folder_name
      get(url)
      .then((res) =>{
          // console.log(res)
          if(res.data.success){
            this.snack = true
            this.snackColor = 'success'
            this.snackText = 'Create Folder success'
            this.getFolderGoogle()
          }
      })
      .catch((err) => {
          console.log(err)
      })
    },

    getFolderGoogle() {

        let url = config.API_URL+'get-folder'
        get(url)
        .then((res) => {
          // console.log(res)
          this.folders = res.data.data
          console.log(this.folders)
        })
        .catch((err) => {
          console.log(err)
        })
    },

    choose(){
       const input = document.createElement('input');
      // const newWindow = openWindow('', 'login')
      input.setAttribute('type', 'file');
      input.click();

      input.onchange = () => {
        const file = input.files[0];

        // file type is only image.
        if (/^image\//.test(file.type)) {
          this.saveToServer(file);
          console.log(file)
        } else {
          console.warn('You could only upload images.')
        }
      }
    }
    
  }
}

</script>

<style lang="css" scoped>
.button-style {
  opacity: 1
}
.style-icon {
  color: pink !important
}
.style_span{
  margin-right: 10px;
}
</style>