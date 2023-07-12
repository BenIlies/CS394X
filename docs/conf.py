import os
import shutil

current_folder = os.getcwd()
print("Current folder location:", current_folder)
parent_folder = os.path.dirname(current_folder)
print("Parent folder location:", parent_folder)

# Define the root and destination paths
root_path = os.path.dirname(os.path.abspath(__file__))
print("Root folder location:", root_path)
docs_path = os.path.join(root_path, 'docs')
print("Doc folder location:", docs_path)

os.chdir(parent_folder)

# Verify the new current working directory
new_current_folder = os.getcwd()
print("New current folder location:", new_current_folder)

# Create the "docs" folder if it doesn't exist
if not os.path.exists(docs_path):
    os.makedirs(docs_path)

# Recursively copy Markdown files from the root folder (excluding "docs") to "docs" folder
for root, dirs, files in os.walk(root_path):
    if 'docs' in dirs:
        dirs.remove('docs')  # Exclude the "docs" folder from further traversal
    for file in files:
        if file.endswith('.md'):
            src_path = os.path.join(root, file)
            dst_dir = os.path.join(docs_path, os.path.relpath(root, root_path))
            dst_path = os.path.join(dst_dir, file)

            if not os.path.exists(dst_dir):
                os.makedirs(dst_dir)

            shutil.copyfile(src_path, dst_path)

extensions = ['myst_parser']

source_suffix = ['.rst', '.md']