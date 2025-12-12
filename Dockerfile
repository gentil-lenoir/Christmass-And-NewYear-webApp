FROM nginx:alpine

COPY . /usr/share/nginx/html/

RUN echo '<!DOCTYPE html>' > /usr/share/nginx/html/index.html
RUN echo '<html>' >> /usr/share/nginx/html/index.html
RUN echo '<head>' >> /usr/share/nginx/html/index.html
RUN echo '<title>Laravel RNDR</title>' >> /usr/share/nginx/html/index.html
RUN echo '<style>' >> /usr/share/nginx/html/index.html
RUN echo 'body { font-family: Arial; padding: 40px; text-align: center; }' >> /usr/share/nginx/html/index.html
RUN echo '.success { color: green; font-size: 24px; }' >> /usr/share/nginx/html/index.html
RUN echo '</style>' >> /usr/share/nginx/html/index.html
RUN echo '</head>' >> /usr/share/nginx/html/index.html
RUN echo '<body>' >> /usr/share/nginx/html/index.html
RUN echo '<h1 class="success">✅ SERVICE EN LIGNE</h1>' >> /usr/share/nginx/html/index.html
RUN echo '<p>Laravel déployé sur RNDR avec succès</p>' >> /usr/share/nginx/html/index.html
RUN echo '</body>' >> /usr/share/nginx/html/index.html
RUN echo '</html>' >> /usr/share/nginx/html/index.html

EXPOSE 80