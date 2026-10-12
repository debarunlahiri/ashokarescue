# Image Integration Summary

## Overview

Successfully integrated new service images into the Ashoka Rescue website. All HEIC format images were converted to JPG for better web compatibility.

## Images Converted (HEIC to JPG)

### Air Ambulance Images

-   `001 AA.heic` → `001 AA.jpg`
-   `IMG_0103.HEIC` → `IMG_0103.jpg`
-   `IMG_8357.HEIC` → `IMG_8357.jpg`

### Ambulance Others Images

-   `001 AM.heic` → `001 AM.jpg`
-   `003 AM.heic` → `003 AM.jpg`
-   `004 AM.heic` → `004 AM.jpg`
-   `006 AM.heic` → `006 AM.jpg`
-   `IMG_8442.HEIC` → `IMG_8442.jpg`
-   `IMG_9779.HEIC` → `IMG_9779.jpg`

### Commercial Stretcher Images

-   `002 CS.heic` → `002 CS.jpg`
-   `007 CS.heic` → `007 CS.jpg`

### Front Page Image

-   `front_page_image.heic` → `front_page_image.jpg`

## Pages Updated

### 1. index.php (Homepage)

**Updated:** Hero section background image

-   **Old:** `hero-bg.jpg`
-   **New:** `front_page_image.jpg`

### 2. charter-air-ambulance.php

**Service:** Charter Air Ambulance
**Images from:** `images-air_ambulance/`

| Section        | Old Image                                                         | New Image                                          |
| -------------- | ----------------------------------------------------------------- | -------------------------------------------------- |
| Banner         | `/assets/images/hero-bg.jpg`                                      | `/assets/images/images-air_ambulance/002 AA.jpg`   |
| Middle Banner  | `/assets/images/Rectangle-2033.jpg`                               | `/assets/images/images-air_ambulance/IMG_0103.jpg` |
| Footer Image 1 | `/upload/image/24051855034Charter Air Ambulance - image1 (1).jpg` | `/assets/images/images-air_ambulance/003 AA.jpg`   |
| Footer Image 2 | `/upload/image/24052092026Charter Air Ambulance - image - 2.jpg`  | `/assets/images/images-air_ambulance/004 AA.jpg`   |
| Footer Image 3 | `/upload/image/24052351108Charter Air Ambulance - image - 5.jpg`  | `/assets/images/images-air_ambulance/001 AA.jpg`   |

### 3. commercial-stretcher.php

**Service:** Commercial Stretcher
**Images from:** `images-commercial_strectcher/`

| Section        | Old Image                                                                   | New Image                                                   |
| -------------- | --------------------------------------------------------------------------- | ----------------------------------------------------------- |
| Banner         | `/assets/images/hero-bg.jpg`                                                | `/assets/images/images-commercial_strectcher/003 CS.jpg`    |
| Middle Banner  | `/assets/images/Rectangle-2033.jpg`                                         | `/assets/images/images-commercial_strectcher/IMG_0650.jpeg` |
| Footer Image 1 | `/upload/image/2405233202824052090946Commercial Stretcher - image1 (1).jpg` | `/assets/images/images-commercial_strectcher/001 CS.jpg`    |
| Footer Image 2 | `/upload/image/24052091328Commercial Stretcher - image - 3.jpg`             | `/assets/images/images-commercial_strectcher/004 CS.jpg`    |
| Footer Image 3 | `/upload/image/24052091328Commercial Stretcher - image - 4.jpg`             | `/assets/images/images-commercial_strectcher/005 CS.jpg`    |

### 4. ambulance-service.php

**Service:** Ambulance Service
**Images from:** `images-ambulance_others/`

| Section             | Old Image                                                  | New Image                                             |
| ------------------- | ---------------------------------------------------------- | ----------------------------------------------------- |
| Banner              | `/upload/image/24052352159Road Ambulance - image - 1.jpg`  | `/assets/images/images-ambulance_others/002 AM.jpg`   |
| Middle Banner       | `/assets/images/Rectangle-2033.jpg`                        | `/assets/images/images-ambulance_others/005 AM.jpg`   |
| Medical Staff Image | `/assets/images/hero-bg.jpg`                               | `/assets/images/images-ambulance_others/001 AM.jpg`   |
| Footer Image 1      | `/upload/image/240520101402Road Ambulance - image - 1.jpg` | `/assets/images/images-ambulance_others/IMG_8442.jpg` |
| Footer Image 2      | `/upload/image/24052352500Road Ambulance - image - 2.jpg`  | `/assets/images/images-ambulance_others/IMG_9779.jpg` |
| Footer Image 3      | `/upload/image/240520101402Road Ambulance - image - 3.jpg` | `/assets/images/images-ambulance_others/003 AM.jpg`   |

### 5. train-ambulance.php

**Service:** Train Ambulance
**Images from:** `images-ambulance_others/`

| Section       | Old Image                                                    | New Image                                           |
| ------------- | ------------------------------------------------------------ | --------------------------------------------------- |
| Block 1 Image | `/upload/image/24071914030240716101813madical-transport.jpg` | `/assets/images/images-ambulance_others/004 AM.jpg` |
| Block 2 Image | `/upload/image/24071914030240716101813madical-transport.jpg` | `/assets/images/images-ambulance_others/006 AM.jpg` |

## Available Images Not Yet Used

### Air Ambulance (`images-air_ambulance/`)

-   `1e6c08d5-7f41-4c0a-be31-b8f14bb599c2.JPG`
-   `75a00208-dde2-4392-bb4f-9fc0637ec2d8.JPG`
-   `D954164F-C0C4-4E88-9661-0F90AEF5439F.JPG`
-   `df7a9be8-d5c5-4419-8ba3-b73f14ce09a8.JPG`
-   `IMG_0635.jpeg`
-   `IMG_0636.jpeg`
-   `IMG_0637.jpeg`
-   `IMG_0640.jpeg`
-   `IMG_2474.jpeg`
-   `IMG_8357.jpg`

### Commercial Stretcher (`images-commercial_strectcher/`)

-   `002 CS.jpg`
-   `006 CS.jpg`
-   `007 CS.jpg`
-   `008 CS.jpg`
-   `IMG_2418.jpeg`
-   `IMG_2414.mp4` (video file)

## Notes

1. All HEIC files have been successfully converted to JPG format for better browser compatibility
2. Original HEIC files are still present in the directories
3. The front page now uses the new `front_page_image.jpg`
4. Each service page now uses relevant images from its corresponding folder
5. Some images remain unused and can be utilized for future updates or gallery sections

## Next Steps (Optional)

-   Consider adding image galleries to service pages using the unused images
-   Optimize images for web (compress to reduce file size while maintaining quality)
-   Add alt text descriptions to all images for better SEO
-   Consider creating a carousel/slider on service pages to showcase multiple images
