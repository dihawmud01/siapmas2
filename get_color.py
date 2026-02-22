from PIL import Image
import sys

try:
    img_path = "/home/dihawmud/.gemini/antigravity/brain/92918a68-14a2-4423-8124-f58dde73ce56/uploaded_image_1769017948538.png"
    img = Image.open(img_path)
    # convert to RGB
    img = img.convert('RGB')
    # Get a pixel from the background (e.g. 10, 10 - safely away from borders/text hopefully, or just 0,0)
    # The image shows a large green block. 
    # Let's sample a few points to be sure.
    
    # Sample point 1 (Top Left corner)
    r, g, b = img.getpixel((0, 0))
    print(f"Pixel (0,0): R={r}, G={g}, B={b}")
    
    # Sample point 2 (Middle Left - likely background)
    width, height = img.size
    r2, g2, b2 = img.getpixel((10, height // 2))
    print(f"Pixel (10, mid): R={r2}, G={g2}, B={b2}")

except Exception as e:
    print(f"Error: {e}")
