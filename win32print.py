import win32api
import win32print

# Get the list of installed printers
printer_names = win32print.EnumPrinters(win32print.PRINTER_ENUM_NAME | win32print.PRINTER_ENUM_LOCAL, None, 1)

# Print the printer names
for printer_name in printer_names:
    print(printer_name)