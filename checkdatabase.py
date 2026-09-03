import json

def load_json_file(filename):
    try:
        with open(filename, 'r') as file:
            return json.load(file)
    except FileNotFoundError:
        print(f"Error: File {filename} not found.")
        return {}
    except json.JSONDecodeError:
        print(f"Error: Unable to parse {filename}. It may not be a valid JSON file.")
        return {}

def get_non_voters(data, file_source):
    return [
        {
            'username': username,
            'namadepan': user_data['namadepan'],
            'namabelakang': user_data['namabelakang'],
            'file': file_source
        }
        for username, user_data in data.items()
        if isinstance(user_data, dict) and not user_data.get('hasVote', False)
    ]
putra_data = load_json_file('putra.json')
putri_data = load_json_file('putri.json')

non_voters_putra = get_non_voters(putra_data, 'putra.json')
non_voters_putri = get_non_voters(putri_data, 'putri.json')

all_non_voters = non_voters_putra + non_voters_putri

print("Orang yang belum melakukan vote (Urut dari putra.json ke putri.json):")
for user in all_non_voters:
    print(f"Username: {user['username']}, Name: {user['namadepan']} {user['namabelakang']}, File: {user['file']}")

print(f"\nTotal orang yang belum melakukan vote: {len(all_non_voters)}")
print(f"Dari putra.json: {len(non_voters_putra)}")
print(f"Dari putri.json: {len(non_voters_putri)}")