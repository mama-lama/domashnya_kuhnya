#!/usr/bin/env python3
import sys
import os

try:
    import weasyprint
except ImportError:
    print("Error: weasyprint library is not installed.", file=sys.stderr)
    sys.exit(1)

def main():
    if len(sys.argv) < 2:
        print("Usage: python3 generate_pdf.py <output_path_or_dash>", file=sys.stderr)
        sys.exit(1)
        
    output_path = sys.argv[1]
    
    # Read HTML from stdin
    try:
        html_content = sys.stdin.read()
    except Exception as e:
        print(f"Error reading from stdin: {e}", file=sys.stderr)
        sys.exit(1)
        
    if not html_content.strip():
        print("Error: Input HTML is empty.", file=sys.stderr)
        sys.exit(1)
        
    try:
        # Generate PDF using WeasyPrint
        # Use base_url="/var/www/public" so any relative assets (like public/images) resolve correctly
        html = weasyprint.HTML(string=html_content, base_url="/var/www/public")
        
        if output_path == '-':
            # Write PDF bytes to stdout
            pdf_bytes = html.write_pdf()
            sys.stdout.buffer.write(pdf_bytes)
        else:
            # Ensure the output directory exists
            out_dir = os.path.dirname(os.path.abspath(output_path))
            if out_dir and not os.path.exists(out_dir):
                os.makedirs(out_dir, exist_ok=True)
            html.write_pdf(output_path)
            
    except Exception as e:
        print(f"Error generating PDF with WeasyPrint: {e}", file=sys.stderr)
        sys.exit(1)

if __name__ == '__main__':
    main()
