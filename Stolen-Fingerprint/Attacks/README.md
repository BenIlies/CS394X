# Attack on Fingerprint Theft

For obvious reasons, we are not going to disclose our fingerprints, but here are the steps to follow to reproduce the attack:

1. Fingerprint Acquisition: Take a fingerprint using ink and capture a picture of it.
2. Image Manipulation: Flip the fingerprint picture horizontally.
3. Cropping and Monochrome Translation: Crop the fingerprint image and convert it to a monochrome representation (black or white) based on a threshold.
4. Color Translation: Translate the black and white image into grayscale to control the depth when translating to 3D. Use a third-party website such as [Online JPG Tools](https://onlinejpgtools.com/create-binary-jpg) for this step.
5. Translation to STL Format: Use a third-party website such as [Image to STL](https://imagetostl.com/) to convert the grayscale image to the STL format suitable for 3D printing.
6. Build for 3D Printer: Utilize the HALOT-ONE PLUS Resin 3D Printer (https://store.creality.com/products/halot-one-plus-resin-3d-printer) or a compatible 3D printer to build the 3D model of the fingerprint.

## Instructions

To reproduce the attack on fingerprint theft, follow these steps:

1. Fingerprint Acquisition:
   - Use ink and capture a clear picture of the fingerprint.
   - Ensure the captured image is of sufficient quality for further processing.

2. Image Manipulation:
   - Flip the fingerprint image horizontally.

3. Cropping and Monochrome Translation:
   - Crop the fingerprint image to isolate the fingerprint region of interest.
   - Convert the image to a monochrome representation (black or white) depending on a threshold value. Adjust the threshold to achieve the desired result.

4. Color Translation:
   - Visit the third-party website [Online JPG Tools](https://onlinejpgtools.com/create-binary-jpg).
   - Upload the black and white fingerprint image.
   - Follow the instructions provided on the website to translate the image into a grayscale representation.

5. Translation to STL Format:
   - Visit the third-party website [Image to STL](https://imagetostl.com/).
   - Upload the grayscale fingerprint image.
   - Follow the instructions on the website to convert the image to the STL format suitable for 3D printing.

6. Build for 3D Printer:
   - Prepare the HALOT-ONE PLUS Resin 3D Printer or a compatible 3D printer for printing.
   - Load the generated STL file onto the printer.
   - Initiate the printing process and ensure the fingerprint model is accurately reproduced.
