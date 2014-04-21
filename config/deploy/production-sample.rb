set :stage, :production

# edit the username below to reflect the username
# you use to ssh onto your production server
server 'bupd.me', user: 'USERNAME', roles: [:web]