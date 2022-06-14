import app from 'flarum/admin/app';
import SlackOAuthSettingsPage from './components/SlackOAuthSettingsPage';

app.initializers.add('blomstra/oauth-slack', () => {
  app.extensionData.for('blomstra-oauth-slack').registerPage(SlackOAuthSettingsPage);
});
