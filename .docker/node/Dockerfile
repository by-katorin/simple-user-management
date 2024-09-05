FROM node:20-alpine

# Set working directory
WORKDIR /var/www

COPY package*.json /var/www/

# Install dependencies
RUN npm install

COPY . /var/www
RUN chown -R node:node /var/www

# Expose the listening port
# EXPOSE 3000
EXPOSE 5173

# Run container as non-root (unprivileged) user
# The node user is provided in the Node.js Alpine base image
USER node

# Run npm start script with PM2 when container starts
CMD ["npm", "run", "dev"]