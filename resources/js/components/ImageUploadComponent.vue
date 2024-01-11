<template>
    <div>
        <input name="icon" type="file" @change="onFileChange">
        <div v-if="imageData">
            <vue-cropper
                ref="cropper"
                :src="imageData"
                :view-mode="1"
                :guides="true"
                :background="true"
                :responsive="true"
                :auto-crop-area="0.8"
                :aspect-ratio="1 / 1"
                style="max-width: 100%; height: 300px;"
            ></vue-cropper>
            <div>
                <label for="filename">File Name:</label>
                <input type="text" id="filename" v-model="fileName">
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="cropAndUpload">Crop and Upload</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="shareImage">Share Image</button>
        </div>
    </div>
</template>

<script>
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';

export default {
    components: {
        VueCropper
    },
    data() {
        return {
            imageData: null, // 画像のデータURL
            fileName: '', // ファイル名
        };
    },
    methods: {
        onFileChange(event) {
            const file = event.target.files[0];
            this.fileName = file.name; // ファイル名のセット
            this.previewImage(file);
        },
        previewImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imageData = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        cropAndUpload() {
            const croppedCanvas = this.$refs.cropper.getCroppedCanvas();
            croppedCanvas.toBlob((blob) => {
                // ここでblobを使用して画像をアップロード
                console.log('Cropped and ready for upload...');
            }, 'image/jpeg');
        },
        shareImage() {
            // ここに画像の共有ロジックを実装
            console.log(`Sharing ${this.fileName}`);
        }
    }
};
</script>
