def read_and_write_files():
    try:
        with open("files.txt", "r") as file_list, open("codes.txt", "w") as code_file:
            for file_name in file_list:
                file_name = file_name.strip()  # Remove leading/trailing whitespace
                try:
                    with open(file_name, "r") as current_file:
                        file_content = current_file.read()
                        code_file.write(f"{file_name}\n{file_content}\n\n")
                except FileNotFoundError:
                    print(f"Error: File '{file_name}' not found.")
    except FileNotFoundError:
        print("Error: 'files.txt' not found in the current directory.")

if __name__ == "__main__":
    read_and_write_files()