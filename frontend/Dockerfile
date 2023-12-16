FROM node:lts-alpine

# set the working direction
WORKDIR /app

# install app dependencies
COPY package.json ./
COPY package-lock.json ./

# Fix permissions for packages
# RUN npm config set unsafe-perm true

RUN npm install
RUN npm install -g serve

# Bundle app source
COPY . ./

RUN chown node:node /app/node_modules

#RUN groupadd --force -g 1000 sail
#RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail
#RUN chown -R sail:sail /var/www/ 

# start app
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
